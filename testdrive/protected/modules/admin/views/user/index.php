<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('/user/create')),
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

<h1>Manage Users</h1>

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
	echo Chtml::submitButton('Unban', array('name'=>'noban'));
	echo Chtml::submitButton('Ban', array('name'=>'ban'));
	echo '<br />';
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
		'email',
		'created',
		'ban'=>array(
			'name'=>'ban',
			'value'=>'($data->ban==1)?"ban":"working"',
			'filter'=>array(0=>'working',1=>'ban'),
		),
		'role'=>array(
			'name'=>'role',
			'value'=>'($data->role==0)?"user":"admin"',
			'filter'=>array(0=>'user',1=>'admin'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php
	echo Chtml::endForm();
?>
