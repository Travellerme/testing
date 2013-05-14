<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<?php if(Yii::app()->user->hasFlash('register')): ?>

<div class="flash-success">
<?php echo Yii::app()->user->getFlash('register'); ?>
</div>

<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'user-form',
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
<?php echo $form->labelEx($model,'username'); ?>
<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'username'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'new_password'); ?>
<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'new_password'); ?>
</div>

<div class="row">
<?php echo $form->label($model,'new_confirm'); ?>
<?php echo $form->passwordField($model,'new_confirm',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'new_confirm'); ?>
</div>

<div class="row buttons">
<?php echo CHtml::submitButton("Create"); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
