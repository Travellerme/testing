<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

if (Yii::app()->user->name != 'admin')
{
	$this->layout = '//layouts/column1';
}
else
{
	$this->menu=array(
		array('label'=>'Create User', 'url'=>array('create')),
		array('label'=>'Manage User', 'url'=>array('admin')),
	);
}
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
