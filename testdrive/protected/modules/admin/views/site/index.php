<?php
/* @var $this SiteController */
/* @var $model Site */

$this->breadcrumbs=array(
	Yii::t("main", "Main page")=>array('index'),
	Yii::t("main", "Manage"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Create description for site"), 'url'=>array('create')),
	array('label'=>Yii::t("main", "Update description"), 'url'=>array('update', 'id'=>$model->id)),
);

?>

<h1><?php echo Yii::t("main", "Management description"); ?></h1>


<div class="view">

	<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
	<?php echo $model->description; ?>
	<br />

</div>
