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
				'actions'=>array('index','DelPhoto'),
				'roles'=>array('1'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{

		$model = new Photo();
		if(isset($_FILES['image']))
		{	
			if($model->valid($_FILES['image']['name']))
			{
				$model->attributes=$_POST['Photo'];
				if($model->savePhoto($_FILES['image'],'full_img','images/' . $model->dir) 
					&& $model->savePhoto($_FILES['image'],'small_img','images/' . $model->dir))
				{
					Yii::app()->user->setFlash('upload',Yii::t("main", "Image was uploaded"));
					$this->refresh();
				}				
							
			}
			
		}
				

		//YII::app()->user->setReturnUrl(YII::app()->request->getUrl());

		$this->render('index',array('model'=>$model));
	}
	
	

	public function actionDelPhoto($key=FALSE)
	{
		if($key)
		{
			$photos = Photo::model()->findAll("key_photo=:key",array(':key'=>$key));
			foreach ($photos as $photo)
			{
			   if(is_file(yii::app()->getBasePath()."/../images/".$photo->url.".jpg"))
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
