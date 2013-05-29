<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>

<?php if(Yii::app()->user->hasFlash('addTest')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('addTest'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'test-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>15,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif; ?>
