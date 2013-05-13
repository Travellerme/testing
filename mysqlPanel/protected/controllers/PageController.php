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
				'actions'=>array('index','view'),
				'users'=>array('*'),
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
		$connection=Yii::app()->db;
		
		//$model = Page::model()->findAllByAttributes(array('category_id' => $id));
		$category = Category::model()->findByPk($id);
		
		
		$this->render('index',array(
			'model' => $model,
			'category' => $category,
		));
	}
	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = Page::model()->findByPk($id);
		$user=User::model()->find('id=?',array(trim(strtolower(Yii::app()->user->id))));
		$comment = new Comment;
	
		if(isset($user) && $user->ban ==1)
		{
			$user->addError('ban',Yii::t("main", "Your account was banned. If you just registered, please wait, while your account will be approved"));
			Yii::app()->user->logout();
			$this->redirect('/site/index');
		}
			
		if(Yii::app()->user->isGuest)
			$comment->scenario = 'guest';
		
		if(isset($_POST['Comment']))
		{
			$settings = Setting::model()->findByPk(1);
			$comment->attributes=$_POST['Comment'];
			$comment->event_id = $model->id;
			if($settings->defaultStatusComment == 0)
			{
				$comment->status = 0;
			}
			else
			{
				$comment->status = 1;
			}
			
			if($comment->save())
			{
				
				if($settings->defaultStatusComment == 0)
				{
					Yii::app()->user->setFlash('comment',Yii::t("main", "Your comment was published"));
				}
				else
				{
					Yii::app()->user->setFlash('comment',Yii::t("main", "Please wait while administrator approve your comment"));
				}
				$this->refresh();
				
			}
		}
		
		
		
		$this->render('view',array(
			'model'=>$model,
			'comment'=>$comment,
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
