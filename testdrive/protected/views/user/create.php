<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	Yii::t("main", "Users")=>array('index'),
	Yii::t("main", "Registration"),
);
?>
<h1><?php echo Yii::t("main", "Registration"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
