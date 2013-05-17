<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	"Test"=>array('index'),
	"Add Question",
);

$this->menu=array(
	array('label'=>'Manage Tests', 'url'=>array('index')),
	array('label'=>'Add Test', 'url'=>array('addTest')),

);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/formBuilder.js');

?>

<h1>Add Tests</h1>

<?php if(Yii::app()->user->hasFlash('addRecord')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('addRecord'); ?>
</div>

<?php endif; ?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'setting'=>$setting,
)); ?>





					
