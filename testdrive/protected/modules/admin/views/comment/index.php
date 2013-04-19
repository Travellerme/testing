<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	Yii::t("main", "Comments")=>array('index'),
	Yii::t("main", "Manage"),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t("main", "Manage Comment"); ?></h1>

<p>
<?php
echo Yii::t("main", "You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.");
?>
</p>


<?php echo CHtml::link(Yii::t("main", "Advanced Search"),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
	echo Chtml::form();
	echo Chtml::submitButton(Yii::t("main", "Show"), array('name'=>'approve'));
	echo Chtml::submitButton(Yii::t("main", "Hide"), array('name'=>'disapprove'));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'commentId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width' => 20),
		),
		'status'=>array(
			'name'=>'status',
			'value'=>'($data->status==0)?Yii::t("main", "visible"):Yii::t("main", "blocked")',
			'filter'=>array(1=>Yii::t("main", "blocked"),0=>Yii::t("main", "visible")),
		),
		'content'=>array(
			'name'=>'content',
			'filter'=>false,
			'headerHtmlOptions'=>array('width' => 250),
		),
		'event_id'=>array(
			'name'=>'event_id',
			'value'=>'$data->event->title',
			'filter'=>Page::allEvents(),
		),
		'created'=>array(
			'name'=>'created',
			'filter'=>false,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'($data->user_id)?$data->user->username:""',
			'filter'=>User::allUsers(),
		),
		'guest',
		
		array(
			'class'=>'CButtonColumn',
			'updateButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
<?php
	echo Chtml::endForm();
?>
