<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
	<?php echo Yii::t("main", "Hello") . Yii::app()->user->name; ?>
</p>
