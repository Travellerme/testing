<?php

/**
 * This is the model class for table "tbl_category".
 *
 * The followings are the available columns in table 'tbl_category':
 * @property integer $id
 * @property string $title
 * @property string $position
 */
class Category extends CActiveRecord
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
		return 'tbl_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titleCategory, position', 'required'),
			array('titleCategory', 'length', 'max'=>255),
			array('position', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, titleCategory, position', 'safe', 'on'=>'search'),
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
			'titleCategory' => 'Title',
			'position' => 'Position',
		);
	}
	public function beforeSave()
	{
		if($this->titleCategory)
			$this->titleCategory = trim($this->titleCategory);
	}
	
	public static function allCategories()
	{
		return Chtml::listData(self::model()->findAll(),'id','titleCategory');
	}
	
	public static function findCategory($id)
	{
		
		return $category;
	}
	
	public static function menu($position)
	{
		$models = self::model()->findAllByAttributes(array('position'=>$position));
		$result = array();
		if($position == 'top')
		{
			$result[] = array('label' =>Yii::t("main", "Home"), 'url' => array('/site/index'));
		}
		foreach($models as $key)
		{
			$result[] = array('label' => $key->titleCategory, 'url' => array('/page/index/id/'.$key->id));
		}
		if($position == 'top')
		{
			if(Yii::app()->user->checkAccess('1'))
			{
				$result[] = array('label' =>Yii::t("main", "AdminControl"), 'url' => array('/admin'));
			}
			$result[] = array('label'=>Yii::t("main", "Login"), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest);
			$result[] = array('label'=>Yii::t("main", "Logout").' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest);
			$result[] = array('label'=>Yii::t("main", "Registration"), 'url'=>array('/user/create'), 'visible'=>Yii::app()->user->isGuest);
		}
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
		$criteria->compare('titleCategory',$this->titleCategory,true);
		$criteria->compare('position',$this->position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
