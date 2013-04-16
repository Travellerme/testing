<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t("main", "Photo")=>array('index'),
	Yii::t("main", "Manage"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Delete image"), 'url'=>array('delete')),
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
	<p class="note"><?php echo Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo  CHtml::errorSummary($model); ?>
	<div class="row">
		<b><?php echo Yii::t("main", "Image"); ?></b> <span class="required">*</span><br />
		<?php echo CHtml::FileField('image'); ?>
		<?php echo CHtml::error($model, "image"); ?>
	</div>
	<div class="row">
		<b><?php echo Yii::t("main", "Directory for saving image"); ?></b> <span class="required">*</span><br />
		<?php echo CHtml::activeDropDownList($model,'dir',Photo::allImgDir('images')); ?>
		<?php echo CHtml::error($model,'dir'); ?>
	</div>
	<?php echo CHtml::submitButton(Yii::t("main", "Upload")); ?>
	<?php echo CHtml::endForm(); ?>
</div>
