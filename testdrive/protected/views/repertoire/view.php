<?php
/* @var $this RepertoireController */
/* @var $model Repertoire */

$this->breadcrumbs=array(
	'Repertoires'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Repertoire', 'url'=>array('index')),
	array('label'=>'Create Repertoire', 'url'=>array('create')),
	array('label'=>'Update Repertoire', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Repertoire', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Repertoire', 'url'=>array('admin')),
);
?>

<h1>View Repertoire #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'timeStart',
		'timeEnd',
		'description',
	),
)); ?>
