<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>

<div class="form">
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Page-form',
	'enableAjaxValidation'=>false,
	

)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<label><strong>Add question</strong></label>
		<?php echo $form->textArea($model,'question','',array(
			'class'=>'input-xlarge',
			'rows'=>'3',
		)); ?>
		<?php echo $form->error($model,'question'); ?>
	</div>
	<div class="row">
		<span class="help-block">select the test  you want to add a question</span><br>
		<?php echo $form->dropDownList($model,'test',Test::allTests()); ?>
		<?php echo $form->error($model,'test'); ?>
	</div>
	
	<div class="row" id='answerList'>
		<?php echo $form->textField($model,'answer[]',array(
			'class'=>'input-xxlarge',
			'placeholder'=>'please enter answer',
			'onchange'=>'formBuilder.addField();',
		)); ?>
		<?php echo $form->error($model,'answer'); ?>
	</div>
	<div class="row">
		<span class="help-block">Right answer is</span>
	</div>
	<div class="row" id='checkboxlist'>
		<?php echo $form->checkbox($model,'rightAnswer',array(
			'class'=>'checkbox',
			'id'=>'inlineCheckbox',
			'value'=>'0',
		)); ?> Answer 1
		<?php echo $form->error($model,'rightAnswer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton("Save"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
