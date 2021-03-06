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
	public $testId;
	public $userId;
	public $userTextAnswer;
	public $userCheckboxAnswer;
	public $serverTextAnswer;
	public $serverCheckboxAnswer;
	public $adminVerity;
	public $percentRight;
	public $userSearch;
	public $testSearch;
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
			array('adminVerity', 'validateVerity','on'=>'update'),
			array('id_test, id_user', 'required','on' => 'addTry'),
			array('id_test, id_user', 'numerical', 'integerOnly'=>true, 'on' => 'addTry'),
			array('id_test, id_user', 'safe', 'on' => 'addTry'),
			array('adminVerity','safe'),
			
			//array('percentRight', 'required'),	
			//array('percentRight','numerical','integerOnly'=>true, 'min'=>0, 'max'=>100,'on'=>'checkResult'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, testSearch, statusAccess, userSearch', 'safe', 'on'=>'search'),
		
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
	

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		   'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
		   'test'=>array(self::BELONGS_TO, 'Test', 'id_test'),
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
			'testSearch' => 'Test',
			'userSearch' => 'Username',
			'statusAccess' => 'Status',
			'percentRight' => 'Percent Right',
			'created' => 'Created',
		);
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->statusAccess = 'allow';
			$this->percentRight = 0;
			$this->created = time();
		}
		return parent::beforeSave();
	}
	
	public function updateTextResult($id)
	{
		$connection = Yii::app()->db;
		$tblUserAnswer = "select ua.id from tbl_user_answer ua,tbl_answer_text at, 
		tbl_user_test ut where ua.id_try=ut.id and ua.id=at.id_user_answer and ut.id=:id";
		$command = $connection->createCommand($tblUserAnswer);
		$command->bindParam(":id", $id, PDO::PARAM_INT);
		$userAnswerId = $command->queryAll();
		if(!$userAnswerId)
			return false;
		$verityValues = array_values($this->adminVerity);
		if(($count = count($userAnswerId)) != count($this->adminVerity))
			return false;
		
		$sqlUpdateResult = "update tbl_answer_text set 
		tbl_answer_text.verity=:verity	where id_user_answer = :id limit 1";
		
		$commandUpdate = $connection->createCommand($sqlUpdateResult);
		for ($i=0; $i<$count; $i++)
		{
			
			$commandUpdate->bindParam(":id", $userAnswerId[$i]['id'], PDO::PARAM_INT);
			$commandUpdate->bindParam(":verity", $verityValues[$i], PDO::PARAM_INT);
			$commandUpdate->execute();
				
		}
		return true;
	
		
	}
	
	public function deleteResult($id)
	{
		$connection = Yii::app()->db;
		$sqlDeleteText = "delete ut, ua, at from tbl_user_test as ut, tbl_user_answer as ua, 
		tbl_answer_text as at where ut.id=ua.id_try and ua.id=at.id_user_answer and ut.id=:id";
		$sqlDeleteCheckbox = "delete ut, ua, uma from tbl_user_test as ut, tbl_user_answer as ua, 
		tbl_user_multi_answer as uma where ut.id=ua.id_try and ua.id=uma.id_user_answer and ut.id=:id";
		$sqlDeleteEmptyResult = "delete ut from tbl_user_test as ut where ut.id=:id";
		
		$commandCheckbox = $connection->createCommand($sqlDeleteCheckbox);
		$commandCheckbox->bindParam(":id", $id, PDO::PARAM_INT);
		$commandText = $connection->createCommand($sqlDeleteText);
		$commandText->bindParam(":id", $id, PDO::PARAM_INT);
		$commantEmptyResult = $connection->createCommand($sqlDeleteEmptyResult);
		$commantEmptyResult->bindParam(":id", $id, PDO::PARAM_INT);
		
		$commandCheckbox->execute();
		$commandText->execute();
		$commantEmptyResult->execute();
		
		return true;
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
		t.title, ut.percentRight, q.id AS questionId, q.question, at.answer, at.verity
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
		
		if($this->userTextAnswer)
			$this->defaultRadio();
		
		return true;
	}
	
	private function defaultRadio()
	{
		foreach($this->userTextAnswer as $keyUser)
		{
			$this->adminVerity[$keyUser['questionId']]=$keyUser['verity'];
		}
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
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with = array( 'user','test' );
		$criteria->compare('user.username', $this->userSearch);
		$criteria->compare('test.title', $this->testSearch, true );
		$criteria->compare('t.id',$this->id);
	
		
		$criteria->compare('statusAccess',$this->statusAccess,true);
		$criteria->compare('percentRight',$this->percentRight);
		$criteria->compare('created',$this->created);
		/*$sort = new CSort;
		$sort->defaultOrder = 'id ASC';
		$sort->attributes = array(
			'id' => 'id',
			'statusAccess' => 'statusAccess',
			'percentRight' => 'percentRight',
			'created' => 'created',
			//'title' => 'title',
		);*/
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'userSearch'=>array(
						'asc'=>'user.username',
						'desc'=>'user.username DESC',
					),
					'testSearch'=>array(
						'asc'=>'test.title',
						'desc'=>'test.title DESC',
					),
					'*',
				),
			),
		));
	
	}
}

