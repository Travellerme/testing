<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">
		

	<h3 align="center"><?php echo CHtml::encode($data->title); ?></h3>
		
	<b><?php //echo '['.CHtml::encode($data->getAttributeLabel('timeStart')).'] :'; ?></b>
	<?php echo '['.CHtml::encode($data->timeStart).']'; ?>
	
	<?php echo ($data->timeEnd)?' - ['.CHtml::encode($data->timeEnd).']':''; ?>
	<br />

	<?php 
	echo substr(preg_replace('/(<img.* \/>)/i', ' ', $data->description),0,255).'...';
	//echo $data->description;
	//$category = Category::findCategory($data->id);
	
	?>
	<br />
	Created [<?php echo $data->created; ?>]
	<br /><br />
	
	<?php echo CHtml::link('read more', array('/page/view', 'id'=>$data->id/*, 'category'=>$category->id*/)); ?>
	<br />


</div>
