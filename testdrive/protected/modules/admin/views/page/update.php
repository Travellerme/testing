<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t("main", "Pages")=>array('index'),
	$model->title,
	Yii::t("main", "Update"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Page"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "Create Page"), 'url'=>array('create')),
	array('label'=>Yii::t("main", "View Page"), 'url'=>array('/page/view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t("main", "Update Page") . ' ' . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
