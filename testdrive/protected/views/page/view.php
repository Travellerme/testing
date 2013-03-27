<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Category: '.$model->categoryName->titleCategory=>array('/page/index','id'=>$model->category_id),
	$model->title,
);
?>

<h1><?php echo $model->title; ?></h1>
Created [<?php echo $model->created; ?>]
<hr />
<?php echo '['.CHtml::encode($model->timeStart).']'; ?>
	
<?php echo ($model->timeEnd)?'- ['.CHtml::encode($model->timeEnd).']':''; ?>
<br />

<?php echo $model->description; ?>
<br />

<br />

