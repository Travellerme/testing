<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category: '.$category->titleCategory,
);

?>

<h1>Pages</h1>

<?php
	foreach ($model as $key)
	{
		echo '<h3>'.CHtml::link(CHtml::encode($key->title),array('/page/view/','id'=>$key->id)).'</h3>';
		echo '<b>'.CHtml::encode($key->getAttributeLabel('date')).' : </b>'; 
		echo '['.CHtml::encode($key->timeStart).']'; 
		echo ($key->timeEnd)?' - ['.CHtml::encode($key->timeEnd).']<br />':'<br />';
		//echo substr(preg_replace('/(<img.* \/>)/i', ' ', $key->description),0,255).'...';
		echo substr($key->description,0,255).'...<br />';
		echo 'Created : ['.$key->created.']<br />';
		echo CHtml::link('read more',array('/page/view/','id'=>$key->id)).'<br /><br /><hr>';
	}
	if (!$model)
		echo 'Current category is empty';
?>
