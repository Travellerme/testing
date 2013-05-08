<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	Yii::t("main", "Users")=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t("main", "Update User"), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t("main", "Delete User"), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t("main", "Are you sure you want to delete this item?"))),
	array('label'=>Yii::t("main", "Manage User"), 'url'=>array('index')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'created',
		'email',
		'ban'=>array(
			'name'=>'ban',
			'value'=>($model->ban==1)?Yii::t("main", "Ban"):Yii::t("main", "Working"),
		),
		'role'=>array(
			'name'=>'role',
			'value'=>($model->role==0)?Yii::t("main", "User"):Yii::t("main", "Admin"),
			'filter'=>array(0=>'user',1=>'admin'),
		),
	),
)); ?>
