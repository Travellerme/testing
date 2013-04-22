<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	Yii::t("main", "Video")=>array('index'),
	Yii::t("main", "Create"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Video"), 'url'=>array('index')),
);
?>

<h1><?php echo Yii::t("main", "Create Video"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
