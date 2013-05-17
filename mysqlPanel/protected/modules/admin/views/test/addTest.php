<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Test', 'url'=>array('index')),
	array('label'=>'Add Question', 'url'=>array('addQuestion')),
	array('label'=>'Manage Test Names', 'url'=>array('testName')),
	
);
?>

<h1>Create Test</h1>

<?php echo $this->renderPartial('_formAddTest', array('model'=>$model)); ?>
