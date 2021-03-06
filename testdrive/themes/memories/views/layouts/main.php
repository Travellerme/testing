<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='X-UA-Compatible' content='IE=EmulateIE7' />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title><?php echo Yii::t("main", $this->pageTitle); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if lt IE 7]>
<style>
#content
{
    height:600px !important;
}
</style>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<link rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css' type='text/css' />
</head>

<body class='wsite-theme-light wsite-page- weeblypage-'>
<div id="wrapper">
        <div id="container">
            <div class="title"><span class='wsite-logo'><table style='height:131px'><tr><td><a href='#'><span id="wsite-title"><?php echo Yii::t("main", Yii::app()->name);?></span></a></td></tr></table></span></div>
            <div id="header" class="wsite-header"></div>

            
            <div id="navigation">
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>Category::menu('top'),
				)); ?>
            </div>
			<div id="lang">
				<?php echo CHtml::link(Yii::t("main", "eng"),array('/site/language','lang'=>'en')); ?>
				<?php echo CHtml::link(Yii::t("main", "rus"),array('/site/language', 'lang'=>'ru')); ?>
			</div>
			<?php if(Yii::app()->user->isGuest):?>
				<div id="forgotPass">
					<?php echo CHtml::link(Yii::t("main", "Forgot password?"),array('/user/forgotPass')); ?>
				</div>
			<?php else:?>
				<br />
			<?php endif?>
			
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>
            
            <div id="contenttop">
                <div id="contentbtm">
                    <div id="contentMain">
                <div id='wsite-content' class='wsite-not-footer'>
					<?php echo $content; ?>
				</div>

                    <div class="clear"></div>
                    </div>
                </div>        
            </div>
           
            <div id="footer">
				<?php echo CHtml::link(Yii::t("main", "Contacts"), array('/site/contact')); ?><br />
				Copyright &copy; <?php echo date('Y'); ?> by Vyacheslav Shevchenko.<br/>
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
			</div><!-- footer -->
			<div class="clear"></div>        
        </div>            
    </div> 

</body>
</html>
