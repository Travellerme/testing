<?php

/**
 * This is the model class for table "tbl_video".
 *
 * The followings are the available columns in table 'tbl_video':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $link
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
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
		return 'tbl_video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, link', 'required'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, link, created', 'safe', 'on'=>'search'),
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
			'title' => Yii::t("main", "Title"),
			'description' => Yii::t("main", "Description"),
			'link' => Yii::t("main", "Link"),
			'created' => Yii::t("main", "Created"),
		);
	}
	
	public function beforeSave()
	{
	
		$this->created = time();
		
		if($this->title)
			$this->title = trim($this->title);
			
		return parent::beforeSave();
	}


	public function afterFind()
	{
		$dateFormat = "d.m.Y H:i";
					
		if($this->created)
			$this->created = date($dateFormat,$this->created);
			
		return parent::afterFind();
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>11,
			)
		));
	}
}
