<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Manage Comment', 'url'=>array('index')),
	array('label'=>'Delete Comment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Comment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status'=>array(
			'name'=>'status',
			'value'=>($model->status==0)?"show":"hide",
			'filter'=>array(1=>'hide',0=>'show'),
		),
		'content',
		'event_id'=>array(
			'name'=>'event_id',
			'value'=>$model->event->title,
		),
		'created',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>($model->user_id)?$model->user->username:"",
		),
		'guest'=>array(
			'name'=>'guest',
			'value'=>($model->guest)?$model->guest:"",
		),
	),
)); ?>
