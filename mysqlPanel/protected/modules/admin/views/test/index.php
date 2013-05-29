<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Test'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Add Test', 'url'=>array('addTest')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Test</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
	echo Chtml::form();
	echo Chtml::submitButton('Work', array('name'=>'work'));
	echo Chtml::submitButton('Old', array('name'=>'old'));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'test-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'testId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),			
		),
		'title',
		'status'=>array(
			'name'=>'status',
			'headerHtmlOptions'=>array('width' => 70),
			'filter'=>array('work'=>"Work",'old'=>"Old"),
		),
		array(
			'class'=>'CButtonColumn',
			'deleteButtonOptions'=>array('style'=>'display:none'),
			'updateButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
<?php
	echo Chtml::endForm();
?>
