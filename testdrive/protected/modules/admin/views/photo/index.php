<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);
?>

<h1>Manage Photos</h1>

<div  class="form">
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<p class="note">Поля, отмеченные <span class="required">*</span> должны быть заполнены.</p>
<?=  CHtml::errorSummary($model)?>
<div class="row">
<?= CHtml::activeLabel($model, "alt")?>
<?= CHtml::activeTextField($model, "alt")?>
<?= CHtml::error($model, "alt")?>
</div>
<div class="row">
<?= CHtml::activeLabel($model, "url")?>
<?= CHtml::activeTextField($model, "url")?>
<?= CHtml::error($model, "url")?>
</div>
<div class="row">
<?= CHtml::activeLabel($model, "image")?>
<?php echo CHtml::FileField( 'image'); ?>
<?= CHtml::error($model, "image")?>
</div>
<?= CHtml::submitButton("Загрузить")?>
<?php echo CHtml::endForm(); ?>
</div>
