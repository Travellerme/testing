<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	'Manage',
);

?>

<h1>Manage Results</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'result-grid',
	'dataProvider'=>$model->sqlDataProvider(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 30),
		),
		'username',
		'test'=>array(
			'name'=>'test',
			'headerHtmlOptions'=>array('width' => 70),
		),
		'percentRight'=>array(
			'name'=>'percentRight',
			'value'=>'$data["percentRight"] . " %"',
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
			'deleteButtonOptions'=>array('style'=>'display:none'),
			'viewButtonOptions'=>array('style'=>'display:none'),
		),		
	),
)); ?>
