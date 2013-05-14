<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>"Manage User", 'url'=>array('index')),
	array('label'=>"View User", 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>"Update User", 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1><?php echo "Update Password " . $model->id; ?></h1>

<?php 
	/*echo Chtml::form();
	echo Chtml::passwordField('new_password');
	echo Chtml::passwordField('new_confirm');
	echo Chtml::endForm();*/
echo $this->renderPartial('_formPassword', array('model'=>$model)); ?>

