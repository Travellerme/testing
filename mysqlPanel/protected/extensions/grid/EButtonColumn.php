<?php
/**
 * EButtonColumn modifies the button urls so you can use it with CSqlDataProvider
 * 
 */
class EButtonColumn extends CButtonColumn
{
  public $controllerPath='';
  public $viewButtonUrl='Yii::app()->createUrl("$this->controllerPath/view",array("id"=>$data["id"]))';
  public $updateButtonUrl='Yii::app()->createUrl("$this->controllerPath/update",array("id"=>$data["id"]))';
  public $deleteButtonUrl='Yii::app()->createUrl("$this->controllerPath/delete",array("id"=>$data["id"]))';
  
}
?>
