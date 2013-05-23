<?php

/**
 * This is the model class for table "tbl_test".
 *
 * The followings are the available columns in table 'tbl_test':
 * @property integer $id
 * @property string $title
 */
class Test extends CActiveRecord
{
	public $testId;
	public $questionAll;
	public $question;
	public $answer;
	public $questionAnswer;
	public $typeAnswer;
	public $questionAnswerText;
	public $textQuestion;
	public $checkboxQuestion;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'tbl_test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required', 'on' => 'addTest'),
			array('questionAnswer', 'validateEmptyAnswerCheckbox', 'on'=> 'answerCheckbox'),
			array('questionAnswerText', 'validateEmptyAnswerText', 'on'=> 'answerText'),
			array('title', 'unique'),
			array('title', 'safe'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, status, questionAnswer', 'safe', 'on'=>'search'),
		);
	}
	
	public function validateEmptyAnswerText($attribute,$params)
	{
		foreach ($this->questionAnswerText as $key=>$val)
		{
			if(!$val)
			{
				$this->addError('errorAnswer','You must answer all questions');
				return false;
			}
		}
		return true;
	}
	
	public function validateEmptyAnswerCheckbox($attribute,$params)
	{
		$flag = true;
		foreach($this->questionAnswer as $key => $val)
		{
			if(!(bool)$this->questionAnswer[$key] = array_diff($val, array(0)))
			{
				$this->addError('errorAnswer','You must answer all questions');
				$flag = false;
			}
		}
		return $flag;
	}	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'category'   => array(self::HAS_MANY,   'Page',    'category_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Test',
		);
	}
	
	public function renderDetail($id)
	{
		$connection = Yii::app()->db;
		$sql = "select t.id, t.title as test, t.status as statusTest,
			q.id as questionId, q.question,	a.answer, qa.flagAnswer as verity,
			qt.status as statusQuestion from tbl_test t, tbl_answer a, 
			tbl_question_answer qa,	tbl_question q, tbl_question_test qt 
			where t.id=qt.id_test and qt.id_question=q.id and qa.id_question=q.id 
			and qa.id_answer=a.id and t.id=:id";
		$command = $connection->createCommand($sql);
		$command->bindParam(":id", $id, PDO::PARAM_INT);
	
		return  $command->queryAll();
		
	}
	
	public function findTest($id)
	{
		$connection = Yii::app()->db;
		$textAnswer = "select 
				t.id, t.title, 
				q.id as questionId, q.question
			from 
				tbl_test t,
				tbl_question q, tbl_question_test qt 
			where 
				t.id=qt.id_test and qt.id_question=q.id
				and t.id=':id' and t.status='work' and qt.status='work'
				and qt.typeAnswer='2'";
		$checkboxAnswer = "select 
				t.id, t.title, 
				q.id as questionId, q.question,	a.answer, a.id as answerId,
				qa.flagAnswer as verity 
			from 
				tbl_test t, tbl_answer a, 
				tbl_question_answer qa,	tbl_question q, tbl_question_test qt 
			where 
				t.id=qt.id_test and qt.id_question=q.id and qa.id_question=q.id 
				and qa.id_answer=a.id and t.id=:id and t.status='work' and qt.status='work'
				and qt.typeAnswer='1'";
			
		$commandText = $connection->createCommand($textAnswer);
		$commandCheckbox = $connection->createCommand($checkBoxAnswer);
		$commandText->bindParam(":id", $id, PDO::PARAM_INT);
		$commandCheckbox->bindParam(":id", $id, PDO::PARAM_INT);
		
		if(!$this->textQuestion = $commandText->queryAll())
			return false;
		if(!$this->checkboxQuestion = $commandCheckbox->queryAll())
			return false;
		
	}
	
	private function calculateResult()
	{
		$questionAnswer = array();
		
		$count = count($this->questionAnswer);
		$percentQuestion = 100 / $count;
		$compareQuestion='';
		$verity = 0;
		foreach($this->questionAll as $key)
		{
			if($compareQuestion != $key['questionId'])
			{
				$compareQuestion = $key['questionId'];
				$verity = 0;
			}
			if($key['verity']==1)
				$verity++;
			
			$questionAnswer[$key['questionId']]['verity'] = $verity;
			$questionAnswer[$key['questionId']][$key['answerId']]=$key['verity'];
		}
		
		$priceAnswerGlobal = 0;
		foreach($questionAnswer as $key => $val)
		{
			$priceAnswerLocal = 0;
			$flagAnswer = true;
			$percentAnswer = $percentQuestion / $val['verity'];
			
			foreach($this->questionAnswer[$key] as $subKey => $subVal)
			{
				if($val[$subVal] == 1) 
					$priceAnswerLocal += $percentAnswer;
				else
					$flagAnswer = false;
			}
			if($flagAnswer)
				$priceAnswerGlobal += $priceAnswerLocal;	
		}
		$priceAnswerGlobal = (int)$priceAnswerGlobal;
		
		$this->insertResult($priceAnswerGlobal);
	
		
		
	}
	
	private function insertTextResult()
	{
		if(!$tryId = $this->insertPartResult())
			return false;
		$connection = Yii::app()->db;
		$tblUserAnswer =  "INSERT INTO tbl_user_answer(id, id_question, id_try) 
			VALUES(null,:questionId,:tryId)";
		$commandUserAnswer = $connection->createCommand($tblUserAnswer);
		$tblAnswerText =  "INSERT INTO tbl_answer_text(id, id_user_answer, answer) 
			VALUES(null,:userAnswerId,:answer)";
		$commandAnswerText = $connection->createCommand($tblAnswerText);
		foreach ($this->questionAnswerText as $questionId => $answer)
		{
			$commandUserAnswer->bindParam(":tryId", $tryId, PDO::PARAM_INT);
			$commandUserAnswer->bindParam(":questionId", $questionId, PDO::PARAM_INT);
			if(!$commandUserAnswer->execute())
				return false;
			
			$userAnswerId = Yii::app()->db->getLastInsertId();
			
			$commandAnswerText->bindParam(":userAnswerId", $userAnswerId, PDO::PARAM_INT);
			$commandAnswerText->bindParam(":answer", $answer, PDO::PARAM_STR);
			
			if(!$commandAnswerText->execute())
				return false;	
		}
		return true;
	}
	public function saveAnswer($typeAnswer)
	{
		$this->typeAnswer = $typeAnswer;
		return ($typeAnswer == 1)?$this->calculateResult():$this->insertTextResult();

	}
	
	private function insertPartResult($priceAnswer = null)
	{
		$connection = Yii::app()->db;
		$tblUserTest = "INSERT INTO tbl_user_test(id, id_user, id_test, percentRight, created) 
			VALUES(null,:userId,:testId,:percentRight,:creared)";
		$created = time();
		$userId = Yii::app()->user->id;
		$command = $connection->createCommand($tblUserTest);
		$command->bindParam(":userId", $userId, PDO::PARAM_INT);
		$command->bindParam(":testId", $this->testId, PDO::PARAM_INT);
		$command->bindParam(":percentRight", $priceAnswer, PDO::PARAM_INT);
		$command->bindParam(":creared", $created, PDO::PARAM_INT);
		if(!$command->execute())
			return false;
		return 	$tryId = Yii::app()->db->getLastInsertId();
	}
	
	private function insertResult($priceAnswer)
	{
		if(!$tryId = $this->insertPartResult($priceAnswer))
			return false;
		$connection = Yii::app()->db;
	
		$tblUserAnswer =  "INSERT INTO tbl_user_answer(id, id_question, id_try) 
			VALUES(null,:questionId,:tryId)";
		$commandUserAnswer = $connection->createCommand($tblUserAnswer);
		$tblUserMultiAnswer =  "INSERT INTO tbl_user_multi_answer(id, id_user_answer, id_answer) 
			VALUES(null,:userAnswerId,:answerId)";
		$commandUserMultiAnswer = $connection->createCommand($tblUserMultiAnswer);
				
		foreach ($this->questionAnswer as $question=>$answerArr)
		{
			$commandUserAnswer->bindParam(":tryId", $tryId, PDO::PARAM_INT);
			$commandUserAnswer->bindParam(":questionId", $question, PDO::PARAM_INT);
			if(!$commandUserAnswer->execute())
				return false;
			
			$userAnswerId = Yii::app()->db->getLastInsertId();
			
			foreach($answerArr as $key=>$answerId)
			{
				$commandUserMultiAnswer->bindParam(":userAnswerId", $userAnswerId, PDO::PARAM_INT);	
				$commandUserMultiAnswer->bindParam(":answerId", $answerId, PDO::PARAM_INT);	
				if(!$commandUserMultiAnswer->execute())
					return false;
			}
		}
		return true;
	}
	
	public static function allTests()
	{
		return Chtml::listData(self::model()->findAll(),'id','title');
	}
	
	
	public static function menu()
	{
		$models = self::model()->findAll();
		$result = array();
		$result[] = array('label' =>"Home", 'url' => array('/site/index'));
		
		foreach($models as $key)
		{
			$result[] = array('label' => $key->title, 'url' => array('/test/index/id/'.$key->id));
		}
		
		if(Yii::app()->user->checkAccess('1'))
		{
			$result[] = array('label' =>"AdminControl", 'url' => array('/admin'));
		}
		
		$result[] = array('label'=>"Login", 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest);
		$result[] = array('label'=>"Logout (" . Yii::app()->user->name . ")", 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest);
		
		return $result;
	}
	
	
	 /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
	public function search()
    {

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('status',$this->status,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>11,
            ),    
        ));
    }
}
