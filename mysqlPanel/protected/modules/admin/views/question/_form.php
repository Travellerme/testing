<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $setting Setting */
/* @var $form CActiveForm */
?>

<div class="form">
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Question-form',
	'enableAjaxValidation'=>false,
	

)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<span class="help-block">select the type of answer</span><br>
		<iframe  width="0" height="0" onload='formBuilder.typeAnswer();'></iframe>
		<?php echo $form->dropDownList($model,'typeAnswer',array(1=>'Checkbox',2=>'Text'),
			array('id'=>'typeAnswer','onchange'=>'formBuilder.typeAnswer();')); ?>
		<?php echo $form->error($model,'typeAnswer'); ?>
	</div>
	<div class="row">
		<label><strong>Add question</strong></label>
		<?php echo $form->textArea($model,'question','',array(
			'class'=>'input-xlarge',
			'rows'=>'3',
		)); ?>
		<?php echo $form->error($model,'question'); ?>
	</div>
	<div class="row">
		<span class="help-block">select the test you want to add a question</span><br>
		<?php echo $form->dropDownList($model,'test',Test::allTests()); ?>
		<?php echo $form->error($model,'test'); ?>
	</div>
	
	<div id='checkboxList'>
		
		<div class="row">
			<iframe  width="0" height="0" onload='formBuilder.addField();'></iframe>
			<div id='answerList'>
			</div>
			<?php echo $form->error($model,'answer'); ?>
		</div>
		<div class="row">
			<span class="help-block">Right answer is</span>
		</div>
		<div class="row" >
			<div id='checkboxlist'>
			</div>
			<?php echo $form->error($model,'rightAnswer'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton("Save"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
