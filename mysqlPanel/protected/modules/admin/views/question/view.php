<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Question'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'Manage Question', 'url'=>array('index')),
);
?>

<h1>View Question</h1>
<div class="row">
	<b>Test:</b>
	<?php echo CHtml::encode($model->test); ?>
		<br /><br />
</div>

<div class="row">
	<b>Question:</b>
	<br /><br />
	<?php echo CHtml::encode($model->question); ?>
	<br /><br />
</div>

<div class="row">
	<b>Status:</b>
	<?php echo $model->status; ?>
	<br /><br />
</div>

<?php if($model->checkboxAnswer): ?>
	<div class="row">
		<b>Answers:</b>
		<br /><br />
	</div>

	<?php foreach($model->checkboxAnswer as $key): ?>
		<?php 
			$checkStatus = false;
			if($key['verity'] == 1)
				$checkStatus = true;
		?>

	<div class="row">
		<?php echo CHtml::checkBox('questionAnswer',$checkStatus,array(
			'value'=> $key['id'],
			'disabled'=>true,
			));
		echo ' ' . CHtml::encode($key['answer']); 	?>
	</div>
	<?php endforeach; ?>
<?php else: ?>
	<div class="row">
		question has no answers
		<br /><br />
	</div>
<?php endif; ?>


