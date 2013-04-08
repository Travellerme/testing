<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	Yii::t("main", "Video")=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t("main", "Update"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Video"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "Create Video"), 'url'=>array('create')),
	array('label'=>Yii::t("main", "View Video"), 'url'=>array('/video/view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t("main", "Update Video") . ' ' . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
