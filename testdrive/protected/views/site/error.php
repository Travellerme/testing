<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::t("main",Yii::app()->name) . ' - ' . Yii::t("main", "Error");
$this->breadcrumbs=array(
	Yii::t("main", "Error"),
);
?>

<h2><?php echo Yii::t("main", "Error") . ' ' .$code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
