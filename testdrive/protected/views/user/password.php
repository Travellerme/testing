<?php
/* @var $this UserController */
/* @var $model User */
/*
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
*/
?>
<h1>Change password </h1>

<?php if(Yii::app()->user->hasFlash('password')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('password'); ?>
</div>

<?php endif; ?>

<?php echo $this->renderPartial('_formPassword', array('model'=>$model)); ?>

