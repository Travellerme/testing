<?php
/* @var $this RepertoireController */
/* @var $model Repertoire */

$this->breadcrumbs=array(
	'Repertoires'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Repertoire', 'url'=>array('index')),
);
?>

<h1>Create Event</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
