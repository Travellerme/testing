<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	Yii::t("main", "Users")=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t("main", "Update"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage User"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "View User"), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t("main", "Update Password"), 'url'=>array('password', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t("main", "Update User") . ' ' . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
