<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	Yii::t("main", "Users")=>array('index'),
	Yii::t("main", "Manage"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Create User"), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link("Advanced Search",'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
	echo Chtml::form();
	echo Chtml::submitButton(Yii::t("main", "Admin"), array('name'=>'admin'));
	echo Chtml::submitButton(Yii::t("main", "User"), array('name'=>'user'));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'userId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),
		),
		'username',
		'created',
		'role'=>array(
			'name'=>'role',
			'value'=>'($data->role==0)?Yii::t("main", "User"):Yii::t("main", "Admin")',
			'filter'=>array(0=>Yii::t("main", "User"),1=>Yii::t("main", "Admin")),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php
	echo Chtml::endForm();
?>
