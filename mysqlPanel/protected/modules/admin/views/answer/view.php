<?php
/* @var $this AnswerController */
/* @var $model Answer */

$this->breadcrumbs=array(
	'Answer'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'Manage Answer', 'url'=>array('index')),
);
?>

<h1>View Answer</h1>


<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>

