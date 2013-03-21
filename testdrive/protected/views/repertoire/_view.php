<?php
/* @var $this RepertoireController */
/* @var $data Repertoire */
?>

<div class="view">
		

	<h3 align="center"><?php echo CHtml::encode($data->title); ?></h3>
		
	<b><?php echo CHtml::encode($data->getAttributeLabel('timeStart')); ?>:</b>
	<?php echo CHtml::encode($data->timeStart); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('timeEnd')); ?>:</b>
	<?php echo CHtml::encode($data->timeEnd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo $data->description; ?>
	<br />


</div>
