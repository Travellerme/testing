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
<?php if($model->checkboxQuestion || $model->textQuestion) : ?>
	<div class="view">
		<b>ID Test: </b>[<?php echo CHtml::encode($model->testId); ?>]
		<br /><br />

		<b>Test: </b><?php echo CHtml::encode($model->test); ?> 
		<br /><br />

		<b>Status Test: </b><?php echo CHtml::encode($model->status); ?> 
		<br /><br />
		
		<?php if($model->checkboxQuestion): ?>
			<?php $compareQuestion = '';?>

			<?php foreach($model->checkboxQuestion as $key): ?>
				<?php if($compareQuestion != $key['questionId']) : ?>
				
					<hr />
					<div class="row">
						<b>Question: </b><br />
						<?php echo Question::generateTags($key['question']); ?>
						<br /><br />
						
					</div>
										
					<?php $compareQuestion = $key['questionId']; ?>
					<b>Please choose answer: </b><br />
				
				<?php endif;?>
				<div class="row">
					<?php 
						$flagVerity = false;
						if($key['verity']==1)
							$flagVerity = true;
						echo CHtml::checkBox('questionAnswer',$flagVerity,array('disabled'=>true));
						echo ' ' . CHtml::encode($key['answer']); 
					?>
				
				</div>
						
			<?php endforeach; ?>
		<?php endif;?>
		
		<?php if($model->textQuestion): ?>
			<?php foreach($model->textQuestion as $key): ?>
			
			
				<hr />
				<div class="row">
					<b>Question: </b><br />
					<?php echo  Question::generateTags($key['question']); ?>
					<br /><br />
					
				</div>
				
			<?php endforeach; ?>
		<?php endif;?>
		</div> 
<?php else: ?>
	Results not found
<?php endif; ?>

