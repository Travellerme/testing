<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	"Test"=>array('index'),
	"Manage",
);

$this->menu=array(
	array('label'=>"Add Question", 'url'=>array('addQuestion')),
);

?>

<h1>Manage Tests</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'test-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'questionId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),
		),
		'question',
		'title',
		'status',
		//'rightAnswer',
			
	),
)); ?>

