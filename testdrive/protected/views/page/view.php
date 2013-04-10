<?php
/* @var $this NewsController */
/* @var $model News */
$this->pageTitle=Yii::t("main", Yii::app()->name);
$this->breadcrumbs=array(
	Yii::t("main", "Category") . ' : '.$model->categoryName->titleCategory=>array('/page/index','id'=>$model->category_id),
	$model->title,
);
?>

<h1><?php echo $model->title; ?></h1>

<?php echo Yii::t("main", "Created") . ' [' . $model->created . ']'; ?>
<hr />
<?php if($model->imgUrl):?>
	<?php 
		echo CHtml::image(Yii::app()->baseUrl . '/' . $model->imgUrl,'no_photo',
			array(                                            
				'class'=>'pageImg',
				));
	?> 
<?php endif; ?>
<?php echo '['.CHtml::encode($model->timeStart).']'; ?>
	
<?php echo ($model->timeEnd)?'- ['.CHtml::encode($model->timeEnd).']':''; ?>
<br />

<?php echo $model->description; ?>
<br />

<br />

<hr />



<?php if(Yii::app()->user->hasFlash('comment')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('comment'); ?>
</div>

<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$comment)); ?>

<?php echo '<b>'.Yii::t("main", "Comments").'</b>';  ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>Comment::allComments($model->id),
	'itemView'=>'_viewComment',
	'sorterHeader'=>'Sort by : ',
	'sortableAttributes'=>array('created'),
)); ?>






