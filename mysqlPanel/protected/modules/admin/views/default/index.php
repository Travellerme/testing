<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo Yii::t("main", "Admin Control") ?></h1>

<p>
	<?php echo Yii::t("main", "Hello") . ' <b>' . Yii::app()->user->name . '</b>'; ?>
</p>
