<?php

class ResultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'actions'=>array('index','update'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = '/layouts/column2';
			
		$model=new Result;
		$model->findResult($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Result']))
		{	
			$model->scenario = 'checkResult';
			$model->attributes=$_POST['Result'];
			if($model->validate())
			{
				Result::model()->updateByPk($id, array('percentRight'=>$model->percentRight));
					Yii::app()->user->setFlash('checkResult', 'Your solution saved');
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Result('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Result']))
			$model->attributes=$_GET['Result'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Result the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Result::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Result $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='result-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
