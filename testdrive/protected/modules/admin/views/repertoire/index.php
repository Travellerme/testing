<?php
/* @var $this RepertoireController */
/* @var $model Repertoire */

$this->breadcrumbs=array(
	'Repertoires'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Repertoire', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#repertoire-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Repertoires</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'repertoire-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),
		),
		'title',
		'timeStart'=>array(
			'name'=>'timeStart',
			'filter'=>false,
		),
		'timeEnd'=>array(
			'name'=>'timeEnd',
			'filter'=>false,
		),
		'created'=>array(
			'name'=>'created',
			'filter'=>false,
		),
		'status'=>array(
			'name'=>'status',
			'value'=>'($data->status==1)?"show":"hide"',
			'filter'=>array(0=>'hide',1=>'show'),
		),
		'category_id'=>array(
			'name'=>'category_id',
			//'value'=>'$data->categoryName->titleCategory',
			'filter'=>Category::allCategories(),
		),
		array(
			'class'=>'CButtonColumn',
			'viewButtonOptions'=> array('style'=>'display:none'),
		),
	),
)); ?>
