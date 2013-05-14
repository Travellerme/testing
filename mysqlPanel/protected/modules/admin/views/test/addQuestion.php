<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	"Test"=>array('index'),
	"Add Question",
);

$this->menu=array(
	array('label'=>"Manage Tests", 'url'=>array('index')),
);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/formBuilder.js');

?>

<h1>Add Tests</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


					
