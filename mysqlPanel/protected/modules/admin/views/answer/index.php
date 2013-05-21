<?php
/* @var $this AnswerController */
/* @var $model Answer */

$this->breadcrumbs=array(
	'Answers'=>array('index'),
	'Manage',
);

$this->menu=array(
	
);

?>

<h1>Manage Answers</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'answer-grid',
	'dataProvider'=>$model->sqlDataProvider(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 30),
		),
		'questionId'=>array(
			'name'=>'questionId',
			'headerHtmlOptions'=>array('width' => 30),
			
		),
		'answer'=>array(
			'name'=>'answer',
			'filter'=>false,
		),
		'test'=>array(
			'name'=>'test',
			'headerHtmlOptions'=>array('width' => 70),
		),
		'status'=>array(
			'name'=>'status',
			'headerHtmlOptions'=>array('width' => 70),
			'filter'=>array('work'=>"Work",'old'=>"Old"),
		),
		'verity'=>array(
			'name'=>'verity',
			'headerHtmlOptions'=>array('width' => 70),
			'value'=>'($data["verity"]==1)?"True":"False"',
			'filter'=>array(1=>"True",2=>"False"),
			
		),
		array(
			'class'=>'ext.grid.EButtonColumn',
			'controllerPath'=>'admin/answer',
			'deleteButtonOptions'=>array('style'=>'display:none'),
			'updateButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
