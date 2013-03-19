<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	[<?php echo date('d.m.Y] [H:i',$data->date); ?>]&nbsp;
	<b><?php echo CHtml::encode($data->title); ?></b>
	<br />
	
	<?php echo CHtml::encode($data->partDescription); 
		if(iconv_strlen($data->partDescription,'UTF-8') < iconv_strlen($data->fullDescription))
			echo '...';
	?>
	<br /><br />
	
	<?php echo CHtml::link('read more', array('view', 'id'=>$data->id)); ?>
	<br />

</div>
