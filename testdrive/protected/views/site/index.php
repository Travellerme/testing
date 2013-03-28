<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'css/carousel.css');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/gallery.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/click-carousel.js');

?>

<script type="text/javascript">
	
$(function(){
	$("#container").clickCarousel({margin: 10});	
});

</script>  
<h1>Добро пожаловать в молодежный "Театр Остров"</h1>

<div id="wrapper"> 
	<div id="container">   	
		<?php 
			foreach ($listImg['href'] as $key=>$val)
			{
				$src = preg_replace('/(preview)/i','big',$val);
				echo "<img src='$src'/>";
			}
		 ?>
		
    </div><!-- container -->
	<img id="carouselLeft" src="<?php echo Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/skins/leftArr.jpg'?>" alt="Left Arrow" />
	<img id="carouselRight" src="<?php echo Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/skins/rightArr.jpg'?>" alt="Right Arrow" />
</div>

