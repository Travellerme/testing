<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

 
    <?php echo CHtml::encode($data->content); ?>
    <br />

	<?php if(!$data->user_id): ?>
	
    [<?php echo Yii::t("main", "Written by"); ?>] <b><?php echo Yii::t("main", "guest"); ?></b> 
    <?php echo CHtml::encode($data->guest); ?>
       
    <?php else: ?>
   
    [<?php echo Yii::t("main", "Written by"); ?>] <b><?php echo CHtml::encode($data->user->username); ?></b>
   
    <?php endif; ?>
      
    <?php echo Yii::t("main", "in"); ?> [<?php echo CHtml::encode($data->created); ?>]
    <br />
    
    
</div>
