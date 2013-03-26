<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	
	/*public function titleImage($name, $class='imageEvent')
	{
			if (file_exists(Yii::getPathOfAlias('webroot') . '/images/' . $name) && (bool)$name)
			{
				return Chtml::image(Yii::app()->baseUrl . '/images/' . $name,$name,
					array(
						'class'=>$class,
				));
			}
			else
			{
				return CHtml::image(Yii::app()->baseUrl . '/images/no_photo.gif','No photo',
					array(
						'class'=>'noImage'
				));
			}
	}*/


	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		$models = Page::model()->findAllByAttributes(array('category_id' => $id));
		/*$dataProvider=new CActiveDataProvider('Page',array(
			'pagination'=>array(
				'pageSize'=>11,
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$this->render('index',array(
			'models'=>$models,
		));
		
	}

	/**
	 * Performs the AJAX validation.
	 * @param Page $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
