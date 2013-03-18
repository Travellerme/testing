<?php
/* @var $this RepertoireController */
/* @var $data Repertoire */
?>

<div class="view">
		
	<?php echo $this->titleImage($data->imgUrl); ?> <br />
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('timeStart')); ?>:</b>
	<?php echo CHtml::encode(date('d.m.Y - H:i',$data->timeStart)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('timeEnd')); ?>:</b>
	<?php echo CHtml::encode(date('d.m.Y - H:i',$data->timeEnd)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>
