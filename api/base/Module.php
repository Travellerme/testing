<?php
abstract class Module extends Component
{
	private $_basePath;
	private $_id;
	private $_components=array();
	private $_componentConfig=array();
	
	public function setComponents($components,$merge=true)
	{
		foreach($components as $id=>$component)
			$this->setComponent($id,$component,$merge);
	}
	
	public function setComponent($id,$component)
	{
		
			$this->_componentConfig[$id]=$component;
	}
	
	public function getComponent($id,$createIfNull=true)
	{
		if(isset($this->_components[$id]))
			return $this->_components[$id];
		elseif(isset($this->_componentConfig[$id]) && $createIfNull)
		{
			$config=$this->_componentConfig[$id];
			$component=Api::createComponent($config);
			$component->init();
			return $this->_components[$id]=$component;
		
		}
	}
}
