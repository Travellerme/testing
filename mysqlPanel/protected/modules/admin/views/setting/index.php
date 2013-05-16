<?php
/* @var $this SettingController */

$this->breadcrumbs=array(
	"Settings",
);
?>
<h1>Settings</h1>


<?php if(Yii::app()->user->hasFlash('setting')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('setting'); ?>
</div>

<?php endif; ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setting-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="compactRadioGroup"> <?php
        
		echo $form->radioButtonList($model,'typeAnswer',array(
			'1'=>'Answers checkboxes',
			'2'=>'Answers text fields'
		)); ?>
		<?php echo $form->error($model,'typeAnswer'); ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton("Save"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


