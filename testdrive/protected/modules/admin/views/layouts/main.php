<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t("main", "Home"), 'url'=>array('/site/index')),
				array('label'=>Yii::t("main", "About"), 'url'=>array('/site/page', 'view'=>'about'),
					'items'=>array(
						array('label'=>'Photos', 'url'=>array('site/page', 'view'=>'photos')),
						array('label'=>'Videos', 'url'=>array('site/page', 'view'=>'videos'))
					)),
				array('label'=>Yii::t("main", "Category"), 'url'=>array('/admin/category'),
					'items'=>array(
						array('label'=>Yii::t("main", "News"), 'url'=>array('/news/index')),
						array('label'=>Yii::t("main", "Repertoire"), 'url'=>array('/admin/repertoire'))
					)),
				array('label'=>Yii::t("main", "Users"), 'url'=>array('/admin/user')),
				array('label'=>Yii::t("main", "Logout").' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				
				
			),
			'htmlOptions'=>array('class'=>'nav'),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo CHtml::link(Yii::t("main", "Contacts"), array('/site/contact')); ?><br />
		Copyright &copy; <?php echo date('Y'); ?> by Vyacheslav Shevchenko.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>