<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);
?>

<h1>Manage Photos</h1>

<?php if(Yii::app()->user->hasFlash('upload')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('upload'); ?>
</div>

<?php endif; ?>

<div  class="form">
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<p class="note">Поля, отмеченные <span class="required">*</span> должны быть заполнены.</p>
<?=  CHtml::errorSummary($model)?>
<div class="row">
<?= CHtml::activeLabel($model, "name")?>
<?= CHtml::activeTextField($model, "name")?>
<?= CHtml::error($model, "name")?>
</div>
<div class="row">
<?= CHtml::activeLabel($model, "image")?>
<?php echo CHtml::FileField( 'image'); ?>
<?= CHtml::error($model, "image")?>
</div>
<?= CHtml::submitButton("Загрузить")?>
<?php echo CHtml::endForm(); ?>
</div>
