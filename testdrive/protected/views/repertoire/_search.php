<?php
/* @var $this RepertoireController */
/* @var $model Repertoire */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'imgUrl'); ?>
		<?php echo $form->textField($model,'imgUrl'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timeStart'); ?>
		<?php echo $form->textField($model,'timeStart'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'timeEnd'); ?>
		<?php echo $form->textField($model,'timeEnd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
