<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Page-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),

)); ?>

	<p class="note"><?php Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>
	<p class="note"><?php echo Yii::t("main", "Date must be as"); ?> dd.MM.yyyy hh:mm</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	
	<div class="row">
		<?= CHtml::activeLabel($model, "image")?>
		<?php echo CHtml::FileField('image'); ?>
		<?= CHtml::error($model, "image")?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'timeStart'); ?>
		<?php echo $form->textField($model,'timeStart'); ?>
		<?php echo $form->error($model,'timeStart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timeEnd'); ?>
		<?php echo $form->textField($model,'timeEnd'); ?>
		<?php echo $form->error($model,'timeEnd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('application.extensions.ckeditor.CKEditor', array(
			'model'=>$model,
		    'attribute'=>'description', 
		    'language'=>'ru', 
		    'editorTemplate'=>'full', 
			));
		 ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(0=>Yii::t("main", "Show"),1=>Yii::t("main", "Hide"))); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',Category::allCategories()); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("main", "Create") : Yii::t("main", "Save")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
