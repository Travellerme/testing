<?php

class TestController extends Controller
{
	
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
				'actions'=>array('index','delete','addQuestion','update'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAddQuestion()
	{
		$setting=Setting::model()->findByPk(1);
		$model = new Test;
		if(isset($_POST['Test']))
		{
			$model->scenario = ($setting->typeAnswer == 1)?'addQuestionCheckbox':'addQuestionText';
			$model->attributes=$_POST['Test'];
			
			
			if($model->validate())
			{
				if($model->insertQuestion($setting->typeAnswer))
					echo 'ok';
				
				
				
			}
				//$this->redirect(array('index','id'=>$model->id));
		}
		$this->render('addQuestion',array(
			'model'=>$model,
			'setting'=>$setting,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Test;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Test']))
		{
			$model->attributes=$_POST['Test'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Test']))
		{
			$model->attributes=$_POST['Test'];
			
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Test;
	
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Test']))
			$model->attributes=$_GET['Test'];
		$this->render('index',array(
			'model'=>$model,
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
	 * Performs the AJAX validation.
	 * @param Test $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='test-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
