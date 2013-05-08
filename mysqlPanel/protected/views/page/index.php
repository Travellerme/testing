<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Category: '.$category->titleCategory,
);

?>


<div class="items">
	
	<?php
		foreach ($model as $key)
		{
			echo "<div class='view'>";
			echo '<h3>'.CHtml::link(CHtml::encode($key->title),array('/page/view/','id'=>$key->id)).'</h3>';
			if($key->timeStart)
			{
				echo '<b>'.CHtml::encode($key->getAttributeLabel('date')).' : </b>'; 
				echo '['.CHtml::encode($key->timeStart).']'; 
				echo ($key->timeEnd)?' - ['.CHtml::encode($key->timeEnd).']<br />':'<br />';		
			}
			
			if($key->imgUrl)
			{
				echo CHtml::image(Yii::app()->baseUrl . '/' . $key->imgUrl,'no_photo',
				array(                                            
					'class'=>'pageImg',
				));
			}
	

			echo substr(preg_replace('/(<img.* \/>)/i', ' ', $key->description),0,255).'...<br />';
			//echo substr($key->description,0,255).'...<br />';
			echo Yii::t("main", "Last update") . ' : ['.$key->created.']<br /><br />';
			echo CHtml::link(Yii::t("main", "read more"),array('/page/view/','id'=>$key->id)).'<br />';
			echo "</div>";
		}
		if (!$model)
			echo Yii::t("main", "Current category is empty");
	?>
	
</div>

