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
	public $questionId;
	public $verity;
	public $answer;
	public $questionAnswer;
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
			array('title', 'required'),
			array('title', 'unique'),
			array('title', 'safe'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, status', 'safe', 'on'=>'search'),
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
		$sql = "select t.id, t.title, 
			q.id as questionId, q.question,	a.answer, a.id as answerId,
			qa.flagAnswer as verity from tbl_test t, tbl_answer a, 
			tbl_question_answer qa,	tbl_question q, tbl_question_test qt 
			where t.id=qt.id_test and qt.id_question=q.id and qa.id_question=q.id 
			and qa.id_answer=a.id and t.id=:id and t.status='work' and qt.status='work'";
		$command = $connection->createCommand($sql);
		$command->bindParam(":id", $id, PDO::PARAM_INT);
	
		return  $command->queryAll();
		
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
