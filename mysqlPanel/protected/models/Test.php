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
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
		);
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
