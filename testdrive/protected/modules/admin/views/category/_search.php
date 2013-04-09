<?php
/* @var $this CategoryController */
/* @var $model Category */
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
		<?php echo $form->label($model,'titleCategory'); ?>
		<?php echo $form->textField($model,'titleCategory',array('size'=>30,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->dropDownList($model,'position',array(''=>'','top'=>Yii::t("main", "Top menu"),'left'=>Yii::t("main", "Left menu"))); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t("main", "Search")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
