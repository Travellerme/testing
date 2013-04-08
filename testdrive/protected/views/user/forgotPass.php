<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

?>

<h3><?php echo Yii::t("main", "Password recovery"); ?></h3>

<?php if(Yii::app()->user->hasFlash('recoverPassword')): ?>

<div class="flash-success">
<?php echo Yii::app()->user->getFlash('recoverPassword'); ?>
</div>

<?php endif; ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
 
<?php echo CHtml::errorSummary($model); ?>

<p class="note"><?php echo Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>
 
<div class="row">
<b><?php echo Yii::t("main", "Please enter your Email"); ?> </b><span style="color:red">*</span><br />
<?php echo CHtml::activeTextField($model,'email'); ?>
<?php echo CHtml::error($model,'email'); ?>
</div>
 
<div class="row submit">
<?php echo CHtml::submitButton(Yii::t("main", "Recover")); ?>
</div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
