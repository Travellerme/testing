<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	"Test"=>array('index'),
	"Manage",
);

$this->menu=array(
	array('label'=>'Add Question', 'url'=>array('addQuestion')),
	array('label'=>'Add Test', 'url'=>array('addTest')),
	array('label'=>'Manage Test Names', 'url'=>array('testName')),
	
);

?>

<h1>Manage Tests</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'test-grid',
	//'selectableRows'=>2,
	'dataProvider'=>$model->sqlDataProvider(),
	'filter'=>$model,
	'columns'=>array(
		/*array(
			'class'=>'CCheckBoxColumn',
			'id'=>'questionId',
		),*/
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),
			'filter'=>false,
			
		),
		'question'=>array(
			'name'=>'question',
			'headerHtmlOptions'=>array('width' => 300),
			'filter'=>false,
		),
		'title'=>array(
			'name'=>'title',
			'headerHtmlOptions'=>array('width' => 70),
			//'filter'=>'',
		),
		'status'=>array(
			'name'=>'status',
			'headerHtmlOptions'=>array('width' => 50),
			'filter'=>false,
		),
		array(
			'class'=>'ext.grid.EButtonColumn',
			'controllerPath'=>'admin/test',
		),

					
	),
)); ?>

