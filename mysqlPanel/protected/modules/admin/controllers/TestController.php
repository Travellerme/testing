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
				'actions'=>array('index','view','addTest'),
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
		$model=new Test;
		$model->renderDetail($id);
		$this->render('view',array(
			'model'=>$model,
		));
    }
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		if(isset($_POST['work']) && isset($_POST['testId']))
			$model = Test::model()->updateByPk($_POST['testId'],array('status'=>'work'));
		else if(isset($_POST['old']) && isset($_POST['testId']))
			$model = Test::model()->updateByPk($_POST['testId'],array('status'=>'old'));
		$model=new Test('search');
        $model->unsetAttributes();  
        if(isset($_GET['Test']))
            $model->attributes=$_GET['Test'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAddTest()
	{
		$model=new Test;
		
		if(isset($_POST['Test']))
		{
			$model->scenario = 'addTest';
			$model->attributes=$_POST['Test'];
			if($model->save()) 
				Yii::app()->user->setFlash('addTest', 'New test was added');
		}

		$this->render('addTest',array(
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
