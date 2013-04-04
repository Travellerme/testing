<?php //$this->beginContent('//layouts/main'); ?>
<?php //echo $content ?>
<?php //$this->endContent(); ?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-5">
		<p>
			<h2>Navigation</h2>
			
			<?php $this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'',
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>Category::menu('left'),
					'htmlOptions'=>array('class'=>'operations'),
				));
			$this->endWidget();?>
		</p>
	</div>
	<div id="content" class="span-15">
		<?php echo $content; ?>
	</div><!-- content -->
	
</div>
<?php $this->endContent(); ?>
