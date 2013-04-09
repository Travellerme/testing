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
class Page extends CActiveRecord
{
	public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
			array('timeStart, description, title, status, category_id', 'required'),
			array('timeStart, timeEnd', 'date', 'format'=>'dd.MM.yyyy hh:mm', 'message'=>Yii::t("main", "Incorrect format Date row. It must be")." dd.MM.yyyy hh:mm"),
			//array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'message'=>Yii::t("main", "File must be as image")),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, status, category_id', 'safe', 'on'=>'search'),
		);
	}
	
	public function validateImgName($name)
	{
		if(preg_match('/(.*)\..*$/i',$name,$compare))
		{ 
			$photo = new Photo();
			if(!$photo->searchImg('images/event','full_'.$compare[1]))
			{
				$this->addError('image',Yii::t("main", "This image already exist"));
				return false;
			}
			return true;
		}
		$this->addError('image',Yii::t("main", "Incorrect format"));
		return false;
		
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
			'title' => Yii::t("main", "Title"),
			'timeStart' => Yii::t("main", "Event beginning"),
			'timeEnd' => Yii::t("main", "Ending event"),
			'description' => Yii::t("main", "Description"),
			'category_id' => Yii::t("main", "Category"),
			'status' => Yii::t("main", "Status"),
			'created' => Yii::t("main", "Created"),
			'image' => Yii::t("main", "Image"),
			'imgUrl' => Yii::t("main", "Image url"),
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
		$timestamp=CDateTimeParser::parse($date,'dd.MM.yyyy hh:mm');
		return $timestamp;
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->created = time();
			$this->status = 0;
			if(isset($_FILES['image']))
			{
				$photo = new Photo();
				if($photo->savePhoto($_FILES['image'],'full_img','images/event'))
					$this->imgUrl = 'images/event/full_' . $_FILES['image']['name'];
				else
					return false;
				
			}
		}
		if($this->title)
			$this->title = trim($this->title);
			
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
		$criteria->compare('title',$this->title);
		$criteria->compare('status',$this->status);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>11,
			)
		));
	}
	
}
