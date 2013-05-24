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
			array('percentRight', 'required'),
			array('percentRight','numerical','integerOnly'=>true, 'min'=>0, 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, test', 'safe', 'on'=>'search'),
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
			'id_user' => 'Id User',
			'id_test' => 'Id Test',
			'percentRight' => 'Percent Right',
			'created' => 'Created',
		);
	}
	
	public function findResult($tryId)
	{
		$connection = Yii::app()->db;
		$sql = "SELECT u.username, t.title AS test, ut.created, ut.percentRight, q.question, a.answer AS checkboxAnswer, a.id as answerId, qa.flagAnswer AS verity, q.id AS questionId
		FROM tbl_user u, tbl_test t, tbl_user_test ut, tbl_user_answer ua, tbl_question q, tbl_user_multi_answer uma, tbl_answer a, tbl_question_answer qa
		WHERE u.id = ut.id_user
		AND ut.id_test = t.id
		AND ut.id = ua.id_try
		AND ua.id_question = q.id
		AND ua.id = uma.id_user_answer
		AND uma.id_answer = a.id
		AND a.id = qa.id_answer
		AND ut.id = :id
		";
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
