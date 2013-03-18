<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<?php echo CHtml::encode($data->title); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('partDescription')); ?>:</b>
	<?php echo CHtml::encode($data->partDescription); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('fullDescription')); ?>:</b>
	<?php //echo CHtml::encode($data->fullDescription); ?>
	<br />

	

	<?php echo CHtml::link('read more', array('view', 'id'=>$data->id)); ?>
	<br />

</div>
