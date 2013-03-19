<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

[<?php echo date('d.m.Y] [H:i',$model->date); ?>] <br />
<?php echo CHtml::encode($model->fullDescription); ?> <br /><br />
<?php 
	/*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'partDescription',
		'fullDescription',
		'date',
	),
));*/ ?>
<?php echo CHtml::link('back', array('index')); ?>
