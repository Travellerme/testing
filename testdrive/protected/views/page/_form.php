<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>
<h3>Create comment</h3>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<?php if(Yii::app()->user->isGuest): ?>

		<div class="row">
			<b>Please Introduce </b><span style="color:red">*</span><br />
			<?php echo $form->textField($model,'guest',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'guest'); ?>
		</div>
		
		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->textField($model,'verifyCode'); ?>
			</div>
			<div class="hint">Please enter the letters as they are shown in the image above.
			<br/>Letters are not case-sensitive.</div>
			<?php echo $form->error($model,'verifyCode'); ?>
		</div>
		<?php endif; ?>
	
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Send'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
