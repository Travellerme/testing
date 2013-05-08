<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	Yii::t("main", "Photo")=>array('index'),
	Yii::t("main", "Delete image"),
);

$this->menu=array(
	array('label'=>Yii::t("main", "Upload image"), 'url'=>array('index')),
);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/ajaxWork.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/moduleAdmin.js');

?>

<h1><?php echo Yii::t("main", "Delete image"); ?></h1>

<?php if(Yii::app()->user->hasFlash('delete')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('delete'); ?>
</div>

<?php endif; ?>

<div class="form">
	<?php echo CHtml::form(); ?>
	<p class="note"><?php echo Yii::t("main", 'Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo  CHtml::errorSummary($model); ?>

	<div class="row">
		<b><?php echo Yii::t("main", "Directory"); ?></b> <span class="required">*</span><br />
		<?php echo CHtml::dropDownList('dir',0,Photo::allImgDir('images'),array('onchange'=>'moduleAdmin.start();')); ?>
		<?php echo CHtml::error($model,'dir'); ?>
	</div>
	<iframe  width="0" height="0" onload='moduleAdmin.start();'></iframe>
	<div class="row">
		<b><?php echo Yii::t("main", "Image name"); ?></b> <span class="required">*</span><br />
		<select id="fileList" name="fileList"></select>
	</div>
	<?php echo CHtml::submitButton(Yii::t("main", "Delete image")); ?>
	<?php echo CHtml::endForm(); ?>
</div>

