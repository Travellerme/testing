<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	"Question"=>array('index'),
	"Add Question",
);

$this->menu=array(
	array('label'=>'Manage Question', 'url'=>array('index')),

);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/formBuilder.js');

?>

<h1>Add Question</h1>

<?php if(Yii::app()->user->hasFlash('addRecord')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('addRecord'); ?>
</div>

<?php endif; ?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'setting'=>$setting,
)); ?>





					
