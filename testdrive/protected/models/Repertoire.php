<?php

/**
 * This is the model class for table "tbl_event".
 *
 * The followings are the available columns in table 'tbl_event':
 * @property integer $id
 * @property integer $id_time
 * @property string $description
 *
 * The followings are the available model relations:
 * @property TblEventTime $id0
 */
class Repertoire extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Repertoire the static model class
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
		return 'tbl_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timeStart, timeEnd, description, title, status, category_id', 'required'),
			array('timeStart, timeEnd,', 'date', 'format'=>'d.m.Y H:i', 'message'=>'Incorrect format Date row. It must be d.m.Y H:i'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, imgUrl, timeStart, timeEnd, created, status, category_id', 'safe', 'on'=>'search'),
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
			'categoryName' => array(self::BELONGS_TO,'Category','category_id'),
		);
	}
	
	/*public function findCaregory()
	{
		$connection = Yii::app()->db;
		$sql = 'select c.id, c.title 
			from tbl_event e, tbl_category c where e.category_id=c.id';
		$command = $connection->createCommand($sql);
		$query = $command->queryAll();
		$result = array();
		foreach ($query as $key)
		{
			$result[$key['id']] = $key['title'];
		}
		return $result;
		
	}*/
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'imgUrl' => 'Image url',
			'timeStart' => 'Event beginning',
			'timeEnd' => 'Ending event',
			'description' => 'Description',
			'category_id' => 'Category',
		);
	}
	
	public function afterFind()
	{
		$dateFormat = "d.m.Y H:i";
		if($this->timeStart)
			$this->timeStart = date($dateFormat,$this->timeStart);
			
		if($this->timeEnd)
			$this->timeEnd = date($dateFormat,$this->timeEnd);
			
		if($this->created)
			$this->created = date($dateFormat,$this->created);

		return parent::afterFind();
	}
	
	private function transformDate($date)
	{
		$timestamp=CDateTimeParser::parse($date,'d.m.Y H:i');
		return $timestamp;
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->created = time();
			$this->status = 0;
		}
		if($this->timeStart)
			$this->timeStart = $this->transformDate($this->timeStart);
			
		if($this->timeEnd)
			$this->timeEnd = $this->transformDate($this->timeEnd);
			
		return parent::beforeSave();
	}
	
	public static function allEvents()
	{
		return Chtml::listData(self::model()->findAll(),'id','title');
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
		$criteria->compare('timeStart',$this->timeStart);
		$criteria->compare('title',$this->title);
		$criteria->compare('status',$this->status);
		$criteria->compare('timeEnd',$this->timeEnd);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>11,
			)
		));
	}
	
}
