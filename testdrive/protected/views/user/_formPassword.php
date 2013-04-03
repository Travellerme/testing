<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'password-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>

	<div class="row"> 
		<?php echo $form->label($model,'new_confirm'); ?> 
		<?php echo $form->passwordField($model,'new_confirm',array('size'=>30,'maxlength'=>128)); ?> 
		<?php echo $form->error($model,'new_confirm'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->
	
	
