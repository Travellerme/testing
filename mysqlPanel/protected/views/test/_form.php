<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>



<?php if($test) : ?>

	<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'test-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary($model); ?>

		
		<?php $compareQuestion = '';?>

		<?php foreach($test as $key): ?>
			<?php if($compareQuestion != $key['questionId']) : ?>
			
				<hr />
				<div class="row">
					<b>Question: </b><br />
					<?php echo $form->textArea($model,'question',array(
						'value'=>CHtml::encode($key['question']),
						'readonly'=>true,
						'cols'=> 100,
						'rows'=>3,
					)); ?>
					<br /><br />
					
				</div>
									
				<?php $compareQuestion = $key['questionId']; ?>
				<?php if($model->scenario == 'answerCheckbox'): ?>
					<b>Please choose answer: </b><br />
				<?php elseIf($model->scenario == 'answerText'): ?>
					<b>Please write answer: </b><br />
					<div class="row">
					<?php echo $form->textArea($model,'questionAnswerText[' . $key['questionId'] . ']',array(
						'cols'=> 100,
						'rows'=>3,
					)); ?>
					<?php echo $form->error($model,'answer'); ?>
				</div>
				<?php endif; ?>
			<?php endif;?>
			<?php if($model->scenario == 'answerCheckbox'): ?>
				<div class="row">
					<?php echo $form->checkBox($model,'questionAnswer[' . $key['questionId'] . '][]',array(
						'value'=> $key['answerId'],
					));
						echo ' ' . CHtml::encode($key['answer']); 
					?>
					<?php echo $form->error($model,'answer'); ?>
				</div>
			<?php endif; ?>
			
		<?php endforeach; ?>
		
		<div class="row buttons">
			<?php echo CHtml::submitButton('Send'); ?>
		</div>

		<?php $this->endWidget(); ?>

</div><!-- form -->
<?php else: ?>
	Results not found
<?php endif; ?>

	

	
