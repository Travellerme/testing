<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Photo';
$this->breadcrumbs=array(
	'Photo',
);
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'css/gallery.css');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/gallery.js');
?>


<h1>Photo</h1>


<?php echo Photo::gallery($listImg); ?>

<div id="view">
</div>

<div id="TB_overlay" onclick="closeImg();" hidden></div>
