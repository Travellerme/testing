<?php
/* @var $this SiteController */

$this->pageTitle=Yii::t("main", Yii::app()->name);
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'css/carousel.css');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/jquery-1.9.1.min.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/gallery.js');
$cs->registerScriptFile(Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'js/click-carousel.js');

?>

<script type="text/javascript">
	
$(function(){
	$("#images").clickCarousel({margin: 10});	
});

</script>  
<h1><?php echo Yii::t("main", 'Welcome to the Youth "Theater Island"'); ?></h1>
<div id="galleryBackround">
	<div id="images">   	
		<?php 
			foreach ($listImg['href'] as $key=>$val)
			{
				$src = preg_replace('/(small_)/i','full_',$val);
				echo "<img src='$src'/>";
			}
		 ?>
	</div>
</div>
	

<img id="carouselLeft" src="<?php echo Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/skins/prev-my.png'?>" alt="Left Arrow" />
<img id="carouselRight" src="<?php echo Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images/skins/next-my.png'?>" alt="Right Arrow" />


<br /><br /><br />
<?php 	echo $model->description;	?>






