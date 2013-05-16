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
	public $question;
	public $answer;
	public $rightAnswer;
	public $test;
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
			array('question, rightAnswer, test', 'required','on'=>'addQuestionCheckbox'),
			array('question, test', 'required','on'=>'addQuestionText'),
			array('answer', 'validateAnswer', 'on'=> 'addQuestionCheckbox'),
			array('title', 'required', 'on'=> 'insert'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
		);
	}
	public function validateAnswer($attribute,$params)
	{
		$this->answer = array_diff($this->answer, array(''));
		$flag = false;
		if(!(bool)$this->answer)
		{
			$this->addError('answer','Text field is empty');
			$flag = true;
		}
		if(!(bool)$this->rightAnswer)
		{
			$flag = true;
		}
		if($flag)
			return false;
		foreach ($this->rightAnswer as $key => $val)
		{
			if(!array_key_exists($key, $this->answer))
			{
				$this->addError('rightAnswer','Text field ' . $key . ' is empty');
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
			'title' => 'Title',
		);
	}
	
	public function insertQuestion($typeAnswer)
	{
		$connection = Yii::app()->db;
		$tblQuestion = "INSERT INTO tbl_question(id, question) VALUES(null,:question)";
		$command = $connection->createCommand($tblQuestion);
		$command->bindParam(":question", $this->question, PDO::PARAM_STR);
		if(!$command->execute())
			return false;
		$questionId = Yii::app()->db->getLastInsertId(); 
		if($typeAnswer == 1)
			if(!$this->insertAnswer($questionId))
				return false;
		
		
		$tblQuestionTest = "INSERT INTO tbl_question_test(
			id, 
			id_question,
			id_test,
			typeAnswer,
			status
		) VALUES(
			null,
			:questionId,
			:testId,
			:typeAnswer,
			:status)";
		$command = $connection->createCommand($tblQuestionTest);
		$status = 'work';var_dump($questionId);
		$command->bindParam(":questionId",$questionId,PDO::PARAM_INT);
		$command->bindParam(":testId",$this->test,PDO::PARAM_INT);
		$command->bindParam(":typeAnswer",$typeAnswer,PDO::PARAM_INT);
		$command->bindParam(":status",$status,PDO::PARAM_INT);
		
		if(!$command->execute())
			return false;
			
		return true;
		
	}
	
	private function insertAnswer($questionId)
	{
		
		$connection = Yii::app()->db;
		$tblAnswer = "INSERT INTO tbl_answer(id, answer) VALUES(null,:answer)";
		$command = $connection->createCommand($tblAnswer);
		$tblQuestionAnswer = "INSERT INTO tbl_question_answer(
				id, 
				id_question, 
				id_answer, 
				flagAnswer
			) VALUES(
				null,
				:questionId,
				:answerId,
				:flagAnswer)";
		$commandQuestionAnswer = $connection->createCommand($tblQuestionAnswer);
		foreach ($this->answer as $key=>$val)
		{
			$command->bindParam(":answer",$val,PDO::PARAM_INT);
			if(!$command->execute())
				return false;
			$answerId = Yii::app()->db->getLastInsertId(); 
			
			$flagAnswer = 0;
			if(array_key_exists($key, $this->rightAnswer))
				$flagAnswer = 1;
			
			$commandQuestionAnswer->bindParam(":questionId",$questionId,PDO::PARAM_INT);
			$commandQuestionAnswer->bindParam(":answerId",$answerId,PDO::PARAM_INT);
			$commandQuestionAnswer->bindParam(":flagAnswer",$flagAnswer,PDO::PARAM_INT);
			
			if(!$commandQuestionAnswer->execute())
				return false;
		}
		return true;
	}
	
	public function beforeSave()
	{
		if($this->title)
			$this->title = trim($this->title);
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->titleCategory,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
