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
		<?php  $num = 1; ?>
		<?php echo $form->errorSummary($model); ?>
		
		<?php if($model->userCheckboxAnswer): ?>
			<?php $compareQuestion = ''; $contentRightAnswer =''; ?>

			<?php foreach($model->serverCheckboxAnswer as $keyServer): ?>
				<?php if($compareQuestion != $keyServer['questionId']) : ?>
					<?php echo $contentRightAnswer; ?>
					<hr />
					<div class="row">
						<b><?php echo $num; $num++; ?>. Question: </b><br />
						<?php echo $keyServer['question']; ?>
						<br /><br />
						
					</div>
										
					<?php $compareQuestion = $keyServer['questionId']; $flagAnswer = true; ?>
					<b>User choose: </b><br />
				
				<?php endif;?>
				<div class="row">
					<?php 
						$htmlOptions = array(
							'value'=> $keyServer['answerId'],
							'onclick'=>'return false',
												
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
					<b><?php echo $num; $num++; ?>. Question: </b><br />
					<?php echo $keyUser['question']; ?>
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
					<?php echo $keyUser['answer']; ?>
					
					
				</div>
				<?php echo $form->radioButtonList($model,'adminVerity[' . $keyUser['questionId'] . ']',array(
					'1'=>'right',
					'2'=>'middle',
					'3'=>'false'
				),array( 
					'separator'=>'<br>',
					'labelOptions'=> array('style' => 'display: inline')
				));?>
			<?php endforeach; ?>
		<?php endif;?>
		
		<div class="row">
			<b>Percent Right:</b>
			<?php echo $model->userCheckboxAnswer[0]['percentRight']; ?> %
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
	
	
	
	
