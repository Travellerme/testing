<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	"Question"=>array('index'),
	"Manage",
);

$this->menu=array(
	array('label'=>'Add Question', 'url'=>array('addQuestion')),
);

?>

<h1>Manage Questions</h1>

<?php
	echo CHtml::form();
	echo CHtml::submitButton('Work', array('name'=>'work'));
	echo CHtml::submitButton('Old', array('name'=>'old'));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'question-grid',
	'selectableRows'=>1,
	'dataProvider'=>$model->sqlDataProvider(),
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
		'question'=>array(
			'name'=>'question',
			'headerHtmlOptions'=>array('width' => 300),
			'filter'=>false,
		),
		'test'=>array(
			'name'=>'test',
			'headerHtmlOptions'=>array('width' => 70),
		),
		'status'=>array(
			'name'=>'status',
			'headerHtmlOptions'=>array('width' => 50),
			'filter'=>array('work'=>"Work",'old'=>"Old"),
		),
		array(
			'class'=>'ext.grid.EButtonColumn',
			'controllerPath'=>'admin/question',
			'deleteButtonOptions'=>array('style'=>'display:none'),
			'updateButtonOptions'=>array('style'=>'display:none'),
		),			
	),
)); ?>
<?php
	echo CHtml::endForm();
?>
