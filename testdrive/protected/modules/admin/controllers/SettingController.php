<?php

class SettingController extends Controller
{
	
	public function actionIndex()
	{
		$model=Setting::model()->findByPk(1);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Setting']))
		{
			$model->attributes=$_POST['Setting'];
			if($model->save())
			{
				Yii::app()->user->setFlash('setting', 'Your settings were saved');
			}
				
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
}
