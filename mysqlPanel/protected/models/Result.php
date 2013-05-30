<?php

/**
 * This is the model class for table "tbl_user_test".
 *
 * The followings are the available columns in table 'tbl_user_test':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_test
 * @property integer $percentRight
 * @property integer $created
 */
class Result extends CActiveRecord
{
	public $username;
	public $test;
	public $testId;
	public $userId;
	public $userTextAnswer;
	public $userCheckboxAnswer;
	public $serverTextAnswer;
	public $serverCheckboxAnswer;
	public $adminVerity;
	public $percentRight;
	
	public $questionAnswer;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Result the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user_test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adminVerity', 'validateVerity'),
			//array('percentRight', 'required'),	
			//array('percentRight','numerical','integerOnly'=>true, 'min'=>0, 'max'=>100,'on'=>'checkResult'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, test', 'safe', 'on'=>'search'),
		
		);
	}
	public function validateVerity($attribute,$params)
	{
		foreach ($this->adminVerity as $key=>$val)
		{
			if(!$val)
			{
				if(!$this->getErrors('errorAnswer'))
					$this->addError('errorAnswer','You must enter your solution');
				return false;
			}
		}
		return true;
	}
	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_test' => 'Id Test',
			'percentRight' => 'Percent Right',
			'created' => 'Created',
		);
	}
	private function findTest($tryId)
	{
		$connection = Yii::app()->db;
		$checkboxAnswer = "select 
				t.id, t.title, 
				q.id as questionId, q.question,	a.answer, a.id as answerId,
				qa.flagAnswer as verity 
			from 
				tbl_test t, tbl_answer a, tbl_user_test ut,
				tbl_question_answer qa,	tbl_question q, tbl_question_test qt 
			where 
				t.id=qt.id_test and qt.id_question=q.id and qa.id_question=q.id 
				and qa.id_answer=a.id and t.id=ut.id_test and ut.id=:id
				and qt.typeAnswer='1'";
			
		
		$commandCheckbox = $connection->createCommand($checkboxAnswer);
		$commandCheckbox->bindParam(":id", $tryId, PDO::PARAM_INT);
		
		$this->serverCheckboxAnswer = $commandCheckbox->queryAll();
	
		return true;
		
	}
	 
	public function findResult($tryId)
	{
		$this->findTest($tryId);
		$connection = Yii::app()->db;
	
		$sqlUserAnswerChecbox = "SELECT u.username, ut.id_test as testId, 
		t.title, ut.created, ut.percentRight, a.id as answerId, q.id AS questionId
		FROM tbl_user u, tbl_test t, tbl_user_test ut, tbl_user_answer ua, 
		tbl_question q, tbl_user_multi_answer uma, tbl_answer a
		WHERE u.id = ut.id_user
		AND ut.id_test = t.id
		AND ut.id = ua.id_try
		AND ua.id_question = q.id
		AND ua.id = uma.id_user_answer
		AND uma.id_answer = a.id
		AND ut.id = :id
		";
		$sqlUserAnswerText = "SELECT u.username, ut.id_test as testId, ut.created, 
		t.title, ut.percentRight, q.id AS questionId, q.question, at.answer
		FROM tbl_user u, tbl_test t, tbl_user_test ut, tbl_user_answer ua, 
		tbl_question q, tbl_answer_text at
		WHERE u.id = ut.id_user
		AND ut.id_test = t.id
		AND ut.id = ua.id_try
		AND ua.id_question = q.id
		AND ua.id = at.id_user_answer
		AND ut.id = :id
		";
		
		$commandText = $connection->createCommand($sqlUserAnswerText);
		$commandCheckbox = $connection->createCommand($sqlUserAnswerChecbox);
		$commandText->bindParam(":id", $tryId, PDO::PARAM_INT);
		$commandCheckbox->bindParam(":id", $tryId, PDO::PARAM_INT);
			
		$this->userTextAnswer = $commandText->queryAll();
		$this->userCheckboxAnswer = $commandCheckbox->queryAll();
		$this->username = ($this->userTextAnswer)?$this->userTextAnswer[0]['username']:$this->userCheckboxAnswer[0]['username'];
		$this->test = ($this->userTextAnswer)?$this->userTextAnswer[0]['title']:$this->userCheckboxAnswer[0]['title'];
		$this->testId = ($this->userTextAnswer)?$this->userTextAnswer[0]['testId']:$this->userCheckboxAnswer[0]['testId'];
		$this->percentRight = ($this->userTextAnswer)?$this->userTextAnswer[0]['percentRight']:$this->userCheckboxAnswer[0]['percentRight'];
		
		return true;
	}
	
	public function saveAnswer($id)
	{
		
		$percentTextQuestion = 100 - $this->percentRight;
		$percentOneQuestion = $percentTextQuestion/count($this->userTextAnswer);
		
		$percentSum = $this->percentRight;
		foreach ($this->verity as $questionId=>$statusVerity)
		{
			if($statusVerity==1)
				$percentSum += $percentOneQuestion;
			if($statusVerity==2)
				$percentSum += $percentOneQuestion/2;
		}

		$percentSum = (int)$percentSum;

		if($percentSum == $this->percentRight)
			return true;
		if($this->updateByPk($id, array('percentRight'=>$percentSum)))
			return true;
		return false;

	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CSqlDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function sqlDataProvider()
	{
		
		$count=Yii::app()->db->createCommand('select 
			count(*)
		from 
			tbl_user u, tbl_test t, tbl_user_test ut
		where 
			u.id=ut.id_user and  ut.id_test=t.id')->queryScalar();
		
		$condition = '';
		$condition .= !empty($this->id) ? ' and ut.id ="' . $this->id . '" ' : ' '; 
		$condition .= !empty($this->test) ? ' and t.title ="' . $this->test . '" ' : ' '; 
		$condition .= !empty($this->username) ? ' and u.username ="' . $this->username . '" ' : ' '; 
		$sql = "select 
			ut.id, u.username, t.title as test, ut.created, ut.percentRight
		from 
			tbl_user u, tbl_test t, tbl_user_test ut
		where 
			u.id=ut.id_user and  ut.id_test=t.id  ". $condition;
	
        $config = array(
			'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>11,
            ),    
        );
		return new CSqlDataProvider($sql, $config);
        
	}
	
}
