<?php
/* @var $this RepertoireController */
/* @var $model Repertoire */

$this->breadcrumbs=array(
	'Repertoires'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Repertoire', 'url'=>array('index')),
	array('label'=>'Create Repertoire', 'url'=>array('create')),
	array('label'=>'View Repertoire', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Repertoire', 'url'=>array('admin')),
);
?>

<h1>Update Repertoire <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>