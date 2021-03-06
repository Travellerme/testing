<?php
/* @var $this CommentController */
/* @var $model Comment */
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
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(''=>'',0=>'show',1=>'hide')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_id'); ?>
		<?php echo $form->dropDownList($model,'event_id', Page::allEvents(), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id', User::allUsers(), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest'); ?>
		<?php echo $form->textField($model,'guest',array('size'=>30,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t("main", "Search")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
