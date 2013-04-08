<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	Yii::t("main", "Comments")=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t("main", "Manage Comment"), 'url'=>array('index')),
	array('label'=>Yii::t("main", "Delete Comment"), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t("main", "Are you sure you want to delete this item?"))),
);
?>

<h1>View Comment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status'=>array(
			'name'=>'status',
			'value'=>($model->status==0)?Yii::t("main", "Show"):Yii::t("main", "Hide"),
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
