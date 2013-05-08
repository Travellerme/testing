<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t("main", "Pages")=>array('index'),
	Yii::t("main", "Create"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Page"), 'url'=>array('index')),
);
?>

<h1><?php echo Yii::t("main", "Create Page"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
