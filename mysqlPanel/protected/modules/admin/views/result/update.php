<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	'Check'=>array($model->id),
);

$this->menu=array(
	array('label'=>'Manage Result', 'url'=>array('index')),
);
?>

<h1>Check Result </h1><br />
<?php if(Yii::app()->user->hasFlash('checkResult')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('checkResult'); ?>
	</div>

<?php else: ?>
	<b>Username: </b><?php echo $model->username; ?><br />
	<b>Test: </b><?php echo $model->test; ?><br />

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php endif; ?>
