<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

 
    <?php echo CHtml::encode($data->content); ?>
    <br />

	<?php if(!$data->user_id): ?>
	
    [Written by] <b>guest</b> 
    <?php echo CHtml::encode($data->guest); ?>
       
    <?php else: ?>
   
    [Written by] <b><?php echo CHtml::encode($data->user->username); ?></b>
   
    <?php endif; ?>
      
    in [<?php echo CHtml::encode($data->created); ?>]
    <br />
    
    
</div>
