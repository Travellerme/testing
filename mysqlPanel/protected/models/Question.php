<?php

/**
 * This is the model class for table "tbl_test".
 *
 * The followings are the available columns in table 'tbl_test':
 * @property integer $id
 * @property string $title
 */
class Question extends CActiveRecord
{
	public $question;
	public $status;
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
		return 'tbl_question';
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
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, test, question, status', 'safe', 'on'=>'search'),
		);
	}
	public function validateAnswer($attribute,$params)
	{
		if(!is_array($this->answer))
			$this->answer = array($this->answer);
		$this->answer = array_diff($this->answer, array(''));
		$flag = false;
		if(!(bool)$this->answer)
		{
			$this->addError('answer','Text field is empty');
			$flag = true;
		}
		if(!(bool)$this->rightAnswer)
			$flag = true;
		
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
			'question' => 'Question',
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
		$status = 'work';
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
			
			$flagAnswer = 2; //false answer
			if(array_key_exists($key, $this->rightAnswer))
				$flagAnswer = 1; //true answer
			
			$commandQuestionAnswer->bindParam(":questionId",$questionId,PDO::PARAM_INT);
			$commandQuestionAnswer->bindParam(":answerId",$answerId,PDO::PARAM_INT);
			$commandQuestionAnswer->bindParam(":flagAnswer",$flagAnswer,PDO::PARAM_INT);
			
			if(!$commandQuestionAnswer->execute())
				return false;
		}
		return true;
	}
	
	public function updateStatus($questionId, $status)
	{
		$connection = Yii::app()->db;
		$updateSql = "update tbl_question_test set status=:status where id_question=:id";
		$command = $connection->createCommand($updateSql);
		$command->bindParam(":status",$status,PDO::PARAM_STR);
		$command->bindParam(":id",$questionId[0],PDO::PARAM_INT);
		if(!$command->execute()) 
			return false;
		return true;
	}
	
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CSqlDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function sqlDataProvider()
	{
		
		$count=Yii::app()->db->createCommand('SELECT COUNT(*) from tbl_test t, tbl_question_test qt, tbl_question q 
			where t.id=qt.id_test and qt.id_question=q.id')->queryScalar();
		
		$condition = '';
		$condition .= !empty($this->id) ? ' and q.id ="' . $this->id . '" ' : ' '; 
		$condition .= !empty($this->test) ? ' and t.title ="' . $this->test . '" ' : ' '; 
		$condition .= !empty($this->status) ? ' and qt.status ="' . $this->status . '" ' : ' '; 
		$sql = "select q.id, t.title as test, q.question,  qt.status  
			from tbl_test t, tbl_question_test qt, tbl_question q 
			where t.id=qt.id_test and qt.id_question=q.id" . $condition;
	
        $config = array(
			'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>11,
            ),    
        );
		return new CSqlDataProvider($sql, $config);
        
	}
	
}
