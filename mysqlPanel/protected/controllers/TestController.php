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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		$testTitle = Test::model()->findByPk($id);
		$model = new Test;
		$model->testId = $id;
		$model->findTest($id);
		if(isset($_POST['Test']))
		{
			if(isset($_POST['Test']['questionAnswer']) && isset($_POST['Test']['questionAnswerText']))
				$model->scenario = 'answerBoth';
			elseif(isset($_POST['Test']['questionAnswer']))
				$model->scenario = 'answerCheckbox';
			elseif(isset($_POST['Test']['questionAnswerText']))
				$model->scenario = 'answerText';
			$model->attributes=$_POST['Test'];
			
			if($model->validate())
			{
				if($model->saveAnswer())
				{
					Yii::app()->user->setFlash('test','Your answers were send');
					$this->redirect(Yii::app()->homeUrl);
				}
			}
			
		}
	
		
		$this->render('index',array(
			'model' => $model,
			'testTitle' => $testTitle,
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
