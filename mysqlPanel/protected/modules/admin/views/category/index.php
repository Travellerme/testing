<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	Yii::t("main", "Categories")=>array('index'),
	Yii::t("main", "Manage"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Create Category"), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t("main", "Manage Categories"); ?></h1>

<p>
<?php 
echo Yii::t("main", "You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.");
 ?>
</p>

<?php  echo CHtml::link(Yii::t("main", "Advanced Search"),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),
		),
		'titleCategory',
		'position',
		array(
			'class'=>'CButtonColumn',
			'viewButtonOptions'=> array('style'=>'display:none'),
		),
	),
)); ?>
