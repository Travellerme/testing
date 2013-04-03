<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Video', 'url'=>array('index')),
);
?>

<h1>Create Video</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
