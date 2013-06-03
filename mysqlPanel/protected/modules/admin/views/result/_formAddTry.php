<?php
/* @var $this ResultController */
/* @var $model Result */
/* @var $form CActiveForm */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'result-form',
    'enableAjaxValidation'=>false,
)); ?>

    
    <?php echo $form->errorSummary($model); ?>

	<div class="row">
		<h3>User: <?php echo $model->username; ?></h3>
		
	</div>
   
	<div class="row">
		<span class="help-block">select the test you want to add attempt</span><br>
		<?php echo $form->dropDownList($model,'test',Test::allTests()); ?>
		<?php echo $form->error($model,'test'); ?>
	</div>
	
	

    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
	
	
	
