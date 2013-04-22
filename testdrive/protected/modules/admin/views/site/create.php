<?php
/* @var $this SiteController */
/* @var $model Site */

$this->breadcrumbs=array(
	Yii::t("main", "Main page")=>array('index'),
	Yii::t("main", "Create"),
);
?>

<h1><?php echo Yii::t("main", "Create description for site"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
