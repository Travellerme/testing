<?php
/* @var $this AnswerController */
/* @var $data Answer */
?>

<div class="view">

	<b>Test:</b>
	<?php echo CHtml::encode($data['test']); ?>
	<br /><br />
	
	<b>ID Question:</b>
	<?php echo CHtml::encode($data['questionId']); ?>
	<br /><br />
	
	<b>Question:</b>
	<?php echo CHtml::encode($data['question']); ?>
	<br /><br />

	<b>ID Answer:</b>
	<?php echo CHtml::encode($data['id']); ?>
	<br /><br />
	
	<b>Answer:</b>
	<?php echo CHtml::encode($data['answer']); ?>
	<br /><br />
	
	<b>Verity:</b>
	<?php echo ($data['verity']==1)?'True':'False'; ?>
	<br /><br />
	
	<b>Status:</b>
	<?php echo $data['status']; ?>
	<br /><br />

</div>
