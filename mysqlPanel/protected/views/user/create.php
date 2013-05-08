<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	"Users"=>array('index'),
	"Registration",
);
?>
<h1>Registration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
