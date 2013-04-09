<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

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
				'actions'=>array('create','captcha','forgotPass'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('changePassword'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionChangePassword()
	{
		$id = Yii::app()->user->id;
		
		$model = $this->loadModel($id);
		$model->scenario = 'changePass';
		
		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			if($model->save())
			{
				Yii::app()->user->setFlash('password',Yii::t("main", "Your password was successfully changed and sent to your email"));
				$this->refresh();
			}
		}
		$this->render('password',array(
			'model'=>$model,
		));
	}
	
	public function actionForgotPass()
	{
			$model = new User;
			$model->scenario = 'forgotPass';
			if(isset($_POST['User']))
			{
				$model->attributes = $_POST['User'];
				if($model->validate())
				{
					$searchModel = User::model()->findByAttributes(array('email'=>trim( $_POST['User']['email'])));
					if($searchModel)
					{
						$searchModel->attributes = $_POST['User'];
						$password = $searchModel->recoverPassword();
						$content = 'Your new password '.$password;
						$searchModel->save(false);
						$name='=?UTF-8?B?'.base64_encode(Yii::t("main", 'Theater "Island" greeting you')).'?=';
						$subject='=?UTF-8?B?'.base64_encode(Yii::t("main", "recover password")).'?=';
						$headers="From: $name <{$model->email}>\r\n".
							"Reply-To: {$model->email}\r\n".
							"MIME-Version: 1.0\r\n".
							"Content-type: text/plain; charset=UTF-8";
						mail($searchModel->email,$subject,$content,$headers);
						Yii::app()->user->setFlash('recoverPassword',Yii::t("main", "Your new password was sent to your email"));
						$this->refresh();
					}
					else
						$model->addError('email',Yii::t("main", "This email address does not registered"));
					
				}
			}
			$this->render('forgotPass', array(
				'model'=>$model,
			));
	}
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$model->scenario = 'register';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			$settings = Setting::model()->findByPk(1);
			
			if($settings->defaultStatusUser == 0)
			{
				$model->ban = 0;
			}
			else
			{
				$model->ban = 1;
			}
			if($model->save())
			{
				if($settings->defaultStatusUser == 0)
				{
					Yii::app()->user->setFlash('register',Yii::t("main", "You was registered successfully. You can login"));
				}
				else
				{
					Yii::app()->user->setFlash('register',Yii::t("main", "You was registered successfully. Please wait while administrator approve you"));
				}
				
			}
				
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t("main", "The requested page does not exist."));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
