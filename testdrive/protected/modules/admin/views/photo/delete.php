<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t("main", "Photo")=>array('index'),
	Yii::t("main", "Delete image"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Upload image"), 'url'=>array('index')),
);
?>

<h1><?php echo Yii::t("main", "Delete image"); ?></h1>

<?php if(Yii::app()->user->hasFlash('delete')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('delete'); ?>
</div>

<?php endif; ?>

<div  class="form">
	<?php echo CHtml::form(); ?>
	<p class="note"><?php echo Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo  CHtml::errorSummary($model); ?>

	<div class="row">
		<b><?php echo Yii::t("main", "Directory"); ?></b> <span class="required">*</span><br />
		<?php echo CHtml::activeDropDownList($model,'dir',Photo::allImgDir('images')); ?>
		<?php echo CHtml::error($model,'dir'); ?>
	</div>
	<?php echo CHtml::submitButton(Yii::t("main", "Delete image")); ?>
	<?php echo CHtml::endForm(); ?>
</div>

