<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Add attempt', 'url'=>array('/admin/result/addTry','userId'=>$model->id)),
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

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
	echo Chtml::form();
	echo Chtml::submitButton('Admin', array('name'=>'admin'));
	echo Chtml::submitButton('User', array('name'=>'user'));
		
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
		'created'=>array(
			'name'=>'created',
			'filter'=>false,
		),
		'role'=>array(
			'name'=>'role',
			'value'=>'($data->role==0)?"User":"Admin"',
			'filter'=>array(0=>"User",1=>"Admin"),
		),
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'addTry'=>array(
					'label'=>'Add attempt',
					'url'=>'Yii::app()->createUrl("/admin/result/addTry", array("userId"=>$data->id))',
					'imageUrl'=>Yii::app()->baseUrl . '/images/addTry.png',  
					
				),
			),
			'template'=>'{view} {update} {delete} {addTry}',
		),
	),
)); ?>
<?php
	echo Chtml::endForm();
?>
