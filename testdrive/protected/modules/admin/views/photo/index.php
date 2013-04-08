<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t("main", "Photo")=>array('index'),
	Yii::t("main", "Manage"),
);
?>

<h1><?php echo Yii::t("main", "Manage Photos"); ?></h1>

<?php if(Yii::app()->user->hasFlash('upload')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('upload'); ?>
</div>

<?php endif; ?>

<div  class="form">
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<p class="note"><?php Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>
<?=  CHtml::errorSummary($model)?>
<div class="row">
<?= CHtml::activeLabel($model, "image")?>
<?php echo CHtml::FileField( 'image'); ?>
<?= CHtml::error($model, "image")?>
</div>
<?= CHtml::submitButton(Yii::t("main", "Upload"))?>
<?php echo CHtml::endForm(); ?>
</div>
