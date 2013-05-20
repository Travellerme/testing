<?php

/**
 * This is the model class for table "tbl_answer".
 *
 * The followings are the available columns in table 'tbl_answer':
 * @property integer $id
 * @property string $answer
 */
class Answer extends CActiveRecord
{
	public $test;
	public $questionId;
	public $verity;
	public $status;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Answer the static model class
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
		return 'tbl_answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('answer', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, test, status, verity, questionId', 'safe', 'on'=>'search'),
		);
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
			'answer' => 'Answer',
		);
	}

	public function renderDetail($id)
	{
		$connection = Yii::app()->db;
		$sql = "select a.id, a.answer, qa.flagAnswer as verity, q.question, q.id as questionId, t.title as test, 
			qt.status from tbl_answer a, tbl_question_answer qa, 
			tbl_question q, tbl_test t, tbl_question_test qt 
			where a.id=qa.id_answer and qa.id_question=q.id 
			and q.id=qt.id_question and qt.id_test=t.id and a.id=:id";
		$command = $connection->createCommand($sql);
		$command->bindParam(":id", $id, PDO::PARAM_INT);
	
		return  $command->queryAll();
		
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
		$condition .= !empty($this->id) ? ' and a.id ="' . $this->id . '" ' : ' '; 
		$condition .= !empty($this->questionId) ? ' and q.id ="' . $this->questionId . '" ' : ' '; 
		$condition .= !empty($this->test) ? ' and t.title ="' . $this->test . '" ' : ' '; 
		$condition .= !empty($this->verity) ? ' and qa.flagAnswer ="' . $this->verity . '" ' : ' '; 
		$condition .= !empty($this->status) ? ' and qt.status ="' . $this->status . '" ' : ' '; 
		
		$sql = "select a.id, a.answer, qa.flagAnswer as verity, q.id as questionId, t.title as test, 
			qt.status from tbl_answer a, tbl_question_answer qa, 
			tbl_question q, tbl_test t, tbl_question_test qt 
			where a.id=qa.id_answer and qa.id_question=q.id 
			and q.id=qt.id_question and qt.id_test=t.id" . $condition;
	
        $config = array(
			'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>11,
            ),    
        );
		return new CSqlDataProvider($sql, $config);
       
      
	}
}
