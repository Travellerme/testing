<?php

class AnswerController extends Controller
{
	public $layout='/layouts/column1';
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','update','view'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = '/layouts/column2';
		$model = Answer::model()->renderDetail($id);
		$dataProvider=new CArrayDataProvider($model, array(
			'id'=>'answer',
			'sort'=>array(
				'attributes'=>array(
					 'id', 
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		$this->render('view',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Test the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Test::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,"The requested page does not exist.");
		return $model;
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->layout = '/layouts/column1';
		$model=new Answer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Answer']))
			$model->attributes=$_GET['Answer'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	
	/**
	 * Performs the AJAX validation.
	 * @param Answer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='answer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
