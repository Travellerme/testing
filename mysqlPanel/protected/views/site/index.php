<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>


<h1>Mysql test</h1>


<?php if(Yii::app()->user->isGuest): ?>
	<h4>Hello User<br>
	You must login</h4>
<? else: ?>
	<h4>Hello <?php echo Yii::app()->user->name; ?></h4><br>
<? endif; ?>



