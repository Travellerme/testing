<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forgot password',
);

?>

<h3>Password recovery</h3>

<?php if(Yii::app()->user->hasFlash('recoverPassword')): ?>

<div class="flash-success">
<?php echo Yii::app()->user->getFlash('recoverPassword'); ?>
</div>

<?php endif; ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
 
<?php echo CHtml::errorSummary($model); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p> 
 
<div class="row">
<b>Please enter your Email </b><span style="color:red">*</span><br />
<?php echo CHtml::activeTextField($model,'email'); ?>
<?php echo CHtml::error($model,'email'); ?>
</div>
 
<div class="row submit">
<?php echo CHtml::submitButton('Recover'); ?>
</div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
