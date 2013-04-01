<?php
class PhotoController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow',
				'actions'=>array('index','DesignPhoto','DelPhoto'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex($id=FALSE)
	{
		
		if(!$id)
		{
			$id=Yii::app()->user->id;
		}

		$model = new Photo();

		if(isset($_POST['ajax']) && $_POST['ajax']==='designer-photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//сохраняет новые фотографии
		if(isset ($_FILES['image']) && $_POST['PhotoForm'] )
		{
			$model->savePhoto($_FILES['image'],'full_img');
			$model->savePhoto($_FILES['image'],'small_img');
		}

		//обратный url
		YII::app()->user->setReturnUrl(YII::app()->request->getUrl());

		$this->render('index',array('model'=>$model));
	}
	
	/*public function actionDesignPhoto($id=FALSE)
	{
			
		//$this->usermenu();

		if(!$id)
		{
			$id=Yii::app()->user->id;
		}

		$model = new PhotoForm();

		if(isset($_POST['ajax']) && $_POST['ajax']==='designer-photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//сохраняет новые фотографии
		if(isset ($_FILES['image']) && $_POST['PhotoForm'] )
		{

		  //настройки для БД
		  $model->user_id=$id;
		  $model->alt=$_POST['PhotoForm']['alt'];
		  $model->url=$_POST['PhotoForm']['url'];



		  $model->savePhoto($_FILES['image'],'full_img');
		  $model->savePhoto($_FILES['image'],'small_img');

		}

		 //загружает ранее загруженные фотографии
		$criteria = new CDbCriteria();

		
		$criteria->condition="user_id=:id AND type=:type ";
		$criteria->params=array("id"=>$id,"type"=>'small_img');
		$criteria->order="`create` DESC";

		$photos = Photo::model()->findAll($criteria);


		//обратный url
		YII::app()->user->setReturnUrl(YII::app()->request->getUrl());

		$this->render('photo/index',array('model'=>$model,'photos'=>$photos));
	}
*/

	public function actionDelPhoto($key=FALSE)
	{


		if($key)
		{
			$photos = Photo::model()->findAll("key_photo=:key",array(':key'=>$key));
			foreach ($photos as $photo)
			{
			   if( is_file(yii::app()->getBasePath()."/../images/".$photo->url.".jpg"))
			   {
				   unlink(yii::app()->getBasePath()."/../images/".$photo->url.".jpg");
			   }
			}

			Photo::model()->deleteAll("key_photo=:key",array(':key'=>$key));

		}


		$this->redirect(Yii::app()->user->returnUrl);

	}
}
?>
