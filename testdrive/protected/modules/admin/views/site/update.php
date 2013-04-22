<?php
/* @var $this SiteController */
/* @var $model Site */

$this->breadcrumbs=array(
	'Sites'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("main", "Main page"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "View result"), 'url'=>array('/site/index')),
);
?>

<h1><?php echo Yii::t("main", "Update description"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
