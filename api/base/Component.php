<?php

class Component
{
	public function __get($name)
	{
		$getter='get'.$name;
		if(method_exists($this,$getter))
			return $this->$getter();
		else
			throw new CException('Property ' . get_class($this) . $name . ' is not defined.');
	}
	
	public function __set($name,$value)
	{
		$setter='set'.$name;
		if(method_exists($this,$setter))
			return $this->$setter($value);
		/*if(method_exists($this,'get'.$name))
			throw new Exception('Property ' . get_class($this) . $name . ' is read only.');
		else
			throw new Exception('Property ' .  get_class($this) . $name . ' is not defined.');
	*/}
}
