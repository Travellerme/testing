<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $id
 * @property string $content
 * @property integer $event_id
 * @property integer $created
 * @property integer $user_id
 * @property string $guest
 */
class Comment extends CActiveRecord
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'tbl_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, guest', 'required', 'on'=>'guest'),
			array('content', 'required'),
			//array('event_id, created, user_id, status','safe', 'on'=>'guest'),
			array('event_id, created, user_id', 'numerical', 'integerOnly'=>true),
			array('guest', 'length', 'max'=>255),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'guest'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
			array('id, status, content, event_id, created, user_id, guest', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO,'User','user_id'),
			'event' => array(self::BELONGS_TO,'Page','event_id'),
		);
	}

	public function afterFind()
	{
		$dateFormat = "d.m.Y H:i";
			
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
			$this->guest = trim($this->guest);
		}
		if(!Yii::app()->user->isGuest)
			$this->user_id = Yii::app()->user->id;
		
		return parent::beforeSave();
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => Yii::t("main", "Content"),
			'event_id' => Yii::t("main", "Event"),
			'created' => Yii::t("main", "Created"),
			'user_id' => Yii::t("main", "User"),
			'guest' => Yii::t("main", "Guest"),
			'status' => Yii::t("main", "Status"),
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('created',$this->created);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('guest',$this->guest,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function allComments($pageId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('event_id',$pageId);
		$criteria->compare('status',0);
		$criteria->order = 'created DESC';
		

		return new CActiveDataProvider('Comment', array(
			'criteria'=>$criteria,
		));
	}
}
