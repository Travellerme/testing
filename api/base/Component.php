<?php

class Component
{
	/*
	 * Function checks if get-method exist, and returns his
	 */
	public function __get($name)
	{
		$getter='get'.$name;
		if(method_exists($this,$getter))
			return $this->$getter();
		else
			throw new Exception('Property ' . get_class($this) . $name . ' is not defined.');
	}
	
	/*
	 * Function checks if set-method exist, and returns his
	 */
	public function __set($name,$value)
	{
		$setter='set'.$name;
		if(method_exists($this,$setter))
			return $this->$setter($value);
		if(method_exists($this,'get'.$name))
			throw new Exception('Property ' . get_class($this) . ' - "' . $name . '" is read only.');
		else
			throw new Exception('Property ' .  get_class($this) . ' - "' . $name . '" is not defined.');
	}
}
