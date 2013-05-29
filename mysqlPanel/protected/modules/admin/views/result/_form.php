<?php
/* @var $this ResultController */
/* @var $model Result */
/* @var $form CActiveForm */
?>



	
<?php if($model->userTextAnswer || $model->userCheckboxAnswer) : ?>

	<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'result-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary($model); ?>
		
		<?php if($model->userCheckboxAnswer): ?>
			<?php $compareQuestion = ''; $contentRightAnswer ='';?>

			<?php foreach($model->serverCheckboxAnswer as $keyServer): ?>
				<?php if($compareQuestion != $keyServer['questionId']) : ?>
					<?php echo $contentRightAnswer; ?>
					<hr />
					<div class="row">
						<b>Question: </b><br />
						<?php echo $form->textArea($model,'question',array(
							'value'=>CHtml::encode($keyServer['question']),
							'readonly'=>true,
							'cols'=> 100,
							'rows'=>3,
						)); ?>
						<br /><br />
						
					</div>
										
					<?php $compareQuestion = $keyServer['questionId']; $flagAnswer = true; ?>
					<b>User choose: </b><br />
				
				<?php endif;?>
				<div class="row">
					<?php 
						$htmlOptions = array(
							'value'=> $keyServer['answerId'],
							'disabled'=>true,
												
						); 
						foreach($model->userCheckboxAnswer as $keyUser)
						{
							if($keyServer['answerId'] == $keyUser['answerId'])
								$htmlOptions['checked'] = true;
						}	
					?>
				
					<?php echo $form->checkBox($model,'questionAnswer[' . $keyServer['questionId'] . '][]',$htmlOptions);
						echo ' ' . CHtml::encode($keyServer['answer']); 
					?>
					
				
						
					
					<?php 
						if($flagAnswer)
						{
							$contentRightAnswer =  '<br><b>Right Answer:</b><br />';
							$flagAnswer =false;
						}
						if($keyServer['verity']==1)
						{
							$contentRightAnswer .= $form->checkBox($model,'rightAnswer',array('value'=>$keyServer['answerId'],'disabled'=>true,'checked'=>true));
							$contentRightAnswer .= ' ' . CHtml::encode($keyServer['answer']) . '<br />'; 
							
						}
					?>
					<?php echo $form->error($model,'answer'); ?>
				</div>
						
			<?php endforeach; ?>
			<?php echo $contentRightAnswer;?>
		<?php endif;?>
		
		<?php if($model->userTextAnswer): ?>
			<?php $count = count($model->userTextAnswer); ?>
			<?php foreach($model->userTextAnswer as $keyUser): ?>
			
			
				<hr />
				<div class="row">
					<b>Question: </b><br />
					<?php echo $form->textArea($model,'question',array(
						'value'=>CHtml::encode($keyUser['question']),
						'readonly'=>true,
						'cols'=> 100,
						'rows'=>3,
					)); ?>
					<br /><br />
					
				</div>
				<b>User Answer:</b><br />
				<div class="row">
					<?php $htmlOptions = array(
						'cols'=> 100,
						'rows'=>3,
						'readonly'=>true,
						'value'=>$keyUser['answer'],
						
					);?>
					<?php echo $form->textArea($model,'questionAnswerText[' . $keyUser['questionId'] . ']',$htmlOptions); ?>
					<?php echo $form->error($model,'answer'); ?>
				</div>
			<?php endforeach; ?>
		<?php endif;?>
		
		<div class="row">
			<?php echo $form->textField($model,'percentRight',array(
				'size'=>3,
				'value'=>$model->userCheckboxAnswer[0]['percentRight']
			)); ?>
			<?php echo $form->error($model,'answer'); ?>
		</div>

		
		<div class="row buttons">
			<?php echo CHtml::submitButton('Save'); ?>
		</div>

		<?php $this->endWidget(); ?>

</div><!-- form -->
<?php else: ?>
	Results not found
<?php endif; ?>
	
	
	
	
