<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t("main", "Categories")=>array('index'),
	Yii::t("main", "Create"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Category"), 'url'=>array('index')),
);
?>

<h1><?php echo Yii::t("main", "Create Category"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
