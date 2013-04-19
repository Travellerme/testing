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
				'actions'=>array('index','delete','FolderAjax'),
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
	
	public function actionFolderAjax()
    {
		echo json_encode(Photo::imgList('images/' . $_POST['folder']));
    }

	public function actionDelete()
	{
		$model = new Photo;
		if(isset($_POST['fileList']))
		{
			if(file_exists(yii::app()->getBasePath() . "/../images/" . $_POST['dir'] . '/' . $_POST['fileList']))
		    {
				$result = unlink(yii::app()->getBasePath() . "/../images/" . $_POST['dir'] . '/' . $_POST['fileList']);
				if($result)
				{
					Yii::app()->user->setFlash('delete',Yii::t("main", "Image was deleted"));
					$this->refresh();
				}		
		    }
		    else
				$model->addError('delete',Yii::t("main", "This image does not exist"));
			
		}
		$this->render('delete',array('model'=>$model));
	}
}
?>
