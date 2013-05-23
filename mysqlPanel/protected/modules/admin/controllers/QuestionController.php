<?php

class QuestionController extends Controller
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
				'actions'=>array('index','addQuestion'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAddQuestion()
	{
	
		$model = new Question;
		
		if(isset($_POST['Question']))
		{
			$model->scenario = ($_POST['Question']['typeAnswer'] == 1)?'addQuestionCheckbox':'addQuestionText';
			$model->attributes=$_POST['Question'];
			
			
			if($model->validate())
			{
				if($model->insertQuestion())
					Yii::app()->user->setFlash('addRecord', 'Your record was saved');
			}
				
		}
		$this->render('addQuestion',array(
			'model'=>$model,
		));
	}
	
	
		   
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		if(isset($_POST['work']) && isset($_POST['questionId']))
			$model = Question::model()->updateStatus($_POST['questionId'],'work');
		else if(isset($_POST['old']) && isset($_POST['questionId']))
			$model = Question::model()->updateStatus($_POST['questionId'],'old');
		$model=new Question('search');
        $model->unsetAttributes(); 
        if(isset($_GET['Question']))
            $model->attributes=$_GET['Question'];

        $this->render('index',array(
            'model'=>$model,
        ));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Question the loaded model
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='question-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
