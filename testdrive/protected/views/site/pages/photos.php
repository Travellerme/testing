<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Photos';
$this->breadcrumbs=array(
	'About'=>array('/site/page', 'view'=>'about'),
	'Photos',
);
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'css/gallery.css');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/gallery.js');
?>


<h1>Photos</h1>

<div id="container">
	<?php 
			echo Photo::gallery($listImg);
	 ?>
</div>
<div id="view">
</div>
<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
<div id="TB_overlay" onclick="closeImg();" hidden></div>
