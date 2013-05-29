<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Question'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Test', 'url'=>array('index')),
	
);
?>

<h1>Create Test</h1>

<?php echo $this->renderPartial('_formAddTest', array('model'=>$model)); ?>
