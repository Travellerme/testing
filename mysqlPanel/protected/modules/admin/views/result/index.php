<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	'Manage',
);

?>

<h1>Manage Results</h1>

<?php
	echo CHtml::form();
	echo CHtml::submitButton('Allow', array('name'=>'allow'));
	echo CHtml::submitButton('Reviewed', array('name'=>'reviewed'));
	echo CHtml::submitButton('Denied', array('name'=>'denied'));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'result-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'resultId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 30),
		),
		'username'=>array(
			'name'=>'username',
			'value'=>'$data->user->username',
			'headerHtmlOptions'=>array('width' => 470),
		),
		'statusAccess'=>array(
			'name'=>'statusAccess',
			'headerHtmlOptions'=>array('width' => 70),
			'filter'=>array('denied'=>'Denied','allow'=>'Allow','inProcess'=>'In process','reviewed'=>'Reviewed'),
		),
		'test'=>array(
			'name'=>'test',
			'value'=>'$data->test->title',
			'headerHtmlOptions'=>array('width' => 70),
		),
		'percentRight'=>array(
			'name'=>'percentRight',
			'value'=>'$data->percentRight." %"',
			'headerHtmlOptions'=>array('width' => 70),
			'filter'=>false,
		),
		'created'=>array(
			'name'=>'created',
			'value'=>'date("d.m.Y H:i",$data["created"])',
			'filter'=>false,
		),
		array(
			'class'=>'ext.grid.EButtonColumn',
			'controllerPath'=>'admin/result',
			'viewButtonOptions'=>array('style'=>'display:none'),
		),		
	),
)); ?>
<?php
	echo CHtml::endForm();
?>

