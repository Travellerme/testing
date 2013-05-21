<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Test'=>array('index'),
	'View'
);

$this->menu=array(
	array('label'=>'Manage Test', 'url'=>array('index')),
	array('label'=>'Add Test', 'url'=>array('addTest')),
);
?>

<h1>View Test</h1>
<?php if($test) : ?>
	<div class="view">
		<b>ID Test: </b>[<?php echo CHtml::encode($test[0]['id']); ?>]
		<br /><br />

		<b>Test: </b><?php echo CHtml::encode($test[0]['test']); ?> 
		<br /><br />

		<b>Status Test: </b><?php echo CHtml::encode($test[0]['statusTest']); ?> 
		<br /><br />
		<?php $compareQuestion = '';?>

		<?php foreach($test as $key): ?>
			
			<?php if($compareQuestion != $key['questionId']) : ?>
				</div><div class="view">
					<b>Question: </b><?php echo CHtml::encode($key['question']); ?>
					<br /><br />
					<b>Status Question: </b> <?php echo CHtml::encode($key['statusQuestion']); ?>
					<br /><br />
					<?php $compareQuestion = $key['questionId']; ?>
			  
			<?php endif;?>
			<b>Answer: </b><?php echo CHtml::encode($key['answer']); ?> <br /><br />
			<b>Verity: </b><?php echo ($key['verity']==1)?'True':'False'; ?><br /><br />
		<?php endforeach; ?>
	</div>
<?php else: ?>
	Results not found
<?php endif; ?>

