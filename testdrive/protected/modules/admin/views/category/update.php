<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t("main", "Categories")=>array('index'),
	$model->titleCategory=>array('index','id'=>$model->id),
	Yii::t("main", "Update"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Category"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "Create Category"), 'url'=>array('create')),
);
?>

<h1><?php echo Yii::t("main", "Update Category") . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
