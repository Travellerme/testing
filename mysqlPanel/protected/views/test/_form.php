<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>

<?php if($model->checkboxQuestion || $model->textQuestion) : ?>

	<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'test-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary($model); ?>
		<?php $num=1; ?>
		<?php if($model->checkboxQuestion): ?>
			<?php $compareQuestion = '';?>

			<?php foreach($model->checkboxQuestion as $key): ?>
				<?php if($compareQuestion != $key['questionId']) : ?>
				
					<hr />
					<div class="view">
						<b><?php echo $num++; ?>. Question: </b><br />
						<?php echo $key['question']; ?>
						<br /><br />
						
					</div>
										
					<?php $compareQuestion = $key['questionId']; ?>
					<b>Please choose answer: </b><br />
				
				<?php endif;?>
				<div class="row">
					<?php echo $form->checkBox($model,'questionAnswer[' . $key['questionId'] . '][]',array(
						'value'=> $key['answerId'],
					));
						echo ' ' . CHtml::encode($key['answer']); 
					?>
					<?php echo $form->error($model,'answer'); ?>
				</div>
						
			<?php endforeach; ?>
		<?php endif;?>
		
		<?php if($model->textQuestion): ?>
			<?php foreach($model->textQuestion as $key): ?>
			
			
				<hr />
				<div class="view">
					<b><?php echo $num++; ?>. Question: </b><br />
					<?php echo $key['question']; ?>
					<br /><br />
					
				</div>
				<b>Please write answer: </b><br />
				<div class="row">
					<?php echo $form->textArea($model,'questionAnswerText[' . $key['questionId'] . ']',array(
						'cols'=> 100,
						'rows'=>3,
					)); ?>
					<?php echo $form->error($model,'answer'); ?>
				</div>
			<?php endforeach; ?>
		<?php endif;?>
		
		
		
		
		<div class="row buttons">
			<?php echo CHtml::submitButton('Send'); ?>
		</div>

		<?php $this->endWidget(); ?>

</div><!-- form -->
<?php else: ?>
	Results not found
<?php endif; ?>

	

	
