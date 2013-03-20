<?php

/**
 * This is the model class for table "tbl_news".
 *
 * The followings are the available columns in table 'tbl_news':
 * @property integer $id
 * @property string $partDescription
 * @property string $fullDescription
 * @property integer $date
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return news the static model class
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
		return 'tbl_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullDescription, date, title', 'required'),
			array('date', 'date', 'format'=>'dd/MM/yyyy H/m', 'message'=>'Incorrect format Date row. It must be dd/MM/yyyy H/m'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, partDescription, fullDescription, title, date', 'safe', 'on'=>'search'),
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
	
	public function beforeSave()
	{
		if($this->date)
				$this->date = $this->transformDate();
		if($this->fullDescription)
					$this->partDescription = $this->fullDescription;
		return parent::beforeSave();
	}
	
	public function afterFind()
	{
		if($this->date)
				$this->date = date("d/m/Y H/i",$this->date);
		return parent::afterFind();
	}
	
	private function transformDate()
	{
		$timestamp=CDateTimeParser::parse($this->date,'dd/MM/yyyy H/m');
		return $timestamp;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'partDescription' => 'Part Description',
			'fullDescription' => 'Full Description',
			'date' => 'Date',
			'title' => 'Title',
		);
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
		$criteria->compare('partDescription',$this->partDescription,true);
		$criteria->compare('fullDescription',$this->fullDescription,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>11,
			)
		));
	}
}
