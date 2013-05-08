<?php

/**
 * This is the model class for table "tbl_setting".
 *
 * The followings are the available columns in table 'tbl_setting':
 * @property integer $id
 * @property integer $defaultStatusComment
 * @property integer $defaultStatusUser
 */
class Setting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Setting the static model class
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
		return 'tbl_setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('defaultStatusComment, defaultStatusUser', 'required'),
			array('defaultStatusComment, defaultStatusUser', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, defaultStatusComment, defaultStatusUser', 'safe', 'on'=>'search'),
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
			'defaultStatusComment' => Yii::t("main", "Block comments by default"),
			'defaultStatusUser' => Yii::t("main", "Members are banned by default"),
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
		$criteria->compare('defaultStatusComment',$this->defaultStatusComment);
		$criteria->compare('defaultStatusUser',$this->defaultStatusUser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}