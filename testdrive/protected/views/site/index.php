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

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
