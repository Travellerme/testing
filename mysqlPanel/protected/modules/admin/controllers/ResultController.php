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
				'actions'=>array('index','update','addTry','delete'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->deleteResult($id);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
			
			$testModel = new Test;
			$testModel->findTestResult($model->testId);
			$model->scenario = 'checkResult';
			if($model->userCheckboxAnswer)
				$testModel->scenario = 'answerCheckbox';
			
			$testModel->attributes=$_POST['Result'];
			
			$model->attributes=$_POST['Result'];
			if($model->validate() && $testModel->validate())
			{
				$percentRight = $testModel->adminCalculate();
				if($percentRight || $percentRight===0 )
				{
					$model->updateTextResult($id);
					$model->updateByPk($id, array('percentRight'=>$percentRight,'statusAccess'=>'reviewed'));
					Yii::app()->user->setFlash('checkResult', 'Your solution saved');
					$this->refresh();
				}
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
		
		if(isset($_POST['reviewed']) && isset($_POST['resultId']))
			$model = Result::model()->updateByPk($_POST['resultId'],array('statusAccess'=>'reviewed'),array('condition'=>'statusAccess !="inProcess"'));
		else if(isset($_POST['denied']) && isset($_POST['resultId']))
			$model = Result::model()->updateByPk($_POST['resultId'],array('statusAccess'=>'denied'),array('condition'=>'statusAccess !="reviewed"'));
		$model=new Result('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Result']))
			$model->attributes=$_GET['Result'];
		if(isset($_POST['Result']))
			$model->attributes=$_POST['Result'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionAddTry($userId)
	{
		$model = new Result;
		if(!$userModel = User::model()->findByPk($userId))
			throw new CHttpException(401, 'This user does not exist');
		
		$model->id_user = $userId;
		
		$model->username = $userModel->username;

		if(isset($_POST['Result']))
		{
			$model->id_test = $_POST['Result']['test'];
			$model->scenario = 'addTry';
			if($model->validate())
			{
				if(!$model->findByAttributes(array('id_user' => $model->id_user,'id_test'=>$model->id_test,'statusAccess'=>'allow')))
				{
					if($model->save(false))
							Yii::app()->user->setFlash('addTry', 'Custom attempt has been added');
				}
				else
					Yii::app()->user->setFlash('addTry', 'User already has the ability to pass this test');	
				$this->refresh();
			}
		
		}
		
		$this->render('addTry',array(
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
