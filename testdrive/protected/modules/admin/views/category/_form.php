<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?phph Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titleCategory'); ?>
		<?php echo $form->textField($model,'titleCategory',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'titleCategory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->dropDownList($model,'position',array('top'=>Yii::t("main", "Top menu"),'left'=>Yii::t("main", "Left menu"))); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("main", "Create") : Yii::t("main", "Save")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
