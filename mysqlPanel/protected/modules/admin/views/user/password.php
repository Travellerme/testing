<?php
/* @var $this UserController */
/* @var $model User */
/*
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
*/
$this->menu=array(
	array('label'=>Yii::t("main", "Manage User"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "View User"), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t("main", "Update User"), 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t("main", "Update Password") . $model->id; ?></h1>

<?php 
	/*echo Chtml::form();
	echo Chtml::passwordField('new_password');
	echo Chtml::passwordField('new_confirm');
	echo Chtml::endForm();*/
echo $this->renderPartial('_formPassword', array('model'=>$model)); ?>

