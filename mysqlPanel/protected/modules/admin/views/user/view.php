<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	"Manage Users"=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>"Update User", 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>"Delete User", 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t("main", "Are you sure you want to delete this item?"))),
	array('label'=>"Manage User", 'url'=>array('index')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'created',
		'role'=>array(
			'name'=>'role',
			'value'=>($model->role==0)?"User":"Admin",
			'filter'=>array(0=>'user',1=>'admin'),
		),
	),
)); ?>
