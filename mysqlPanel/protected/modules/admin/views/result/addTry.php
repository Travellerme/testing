<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Users'=>array('/admin/user/index'),
	'Add Try',
);

$this->menu=array(
	array('label'=>'Manage User', 'url'=>array('/admin/user/index')),
);
?>

<h1>Add Try </h1><br />
<?php if(Yii::app()->user->hasFlash('addTry')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('addTry'); ?>
	</div>

<?php endif; ?>

<?php echo $this->renderPartial('_formAddTry', array('model'=>$model)); ?>
