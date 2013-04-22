 <?php
/* @var $this VideoController */
/* @var $data Video */
?>

<div class="view">

    <h3><?php echo CHtml::encode($data->title); ?></h3>
	
	<b><?php echo $data->link; ?></b>
    <br />
    
    <?php echo $data->description; ?>
    <br />

    <?php echo Yii::t("main", "Last update") . ' [' . CHtml::encode($data->created) . ']'; ?>
    <br />

</div> 
