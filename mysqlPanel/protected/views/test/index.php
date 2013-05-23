<?php
/* @var $this TestController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	$testTitle->title,
);
?>

<h1><?php echo $testTitle->title; ?></h1>

<?php if(Yii::app()->user->hasFlash('test')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('test'); ?>
</div>

<?php else: ?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'test'=>$test,
)); ?>

<?php endif; ?>




