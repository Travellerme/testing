<?php

class WebApplication extends BaseApplication
{
	private $_controller;
	private $_controllerPath;
	
	public function processRequest()
	{print_r($this);
		/*$route=$this->getUrlManager()->parseUrl($this->getRequest());
		$this->runController($route);*/
	}
	
	protected function installComponents()
	{
		parent::installComponents();

		$components=array(
			'session'=>array(
				'class'=>'HttpSession',
			),
			'user'=>array(
				'class'=>'WebUser',
			),
			'authManager'=>array(
				'class'=>'PhpAuthManager',
			),
		);

		$this->setComponents($components);
	}
	
	protected function init()
	{
		parent::init();
		// preload 'request' so that it has chance to respond to onBeginRequest event.
		//$this->getRequest();
		
	}
	
	public function getAuthManager()
	{
		return $this->getComponent('authManager');
	}
	
	public function getSession()
	{
		return $this->getComponent('session');
	}
	
	public function getUser()
	{
		return $this->getComponent('user');
	}
	
	public function runController($route)
	{
		if(($ca=$this->createController($route))!==null)
		{
			list($controller,$actionID)=$ca;
			$oldController=$this->_controller;
			$this->_controller=$controller;
			$controller->init();
			$controller->run($actionID);
			$this->_controller=$oldController;
		}
		else
			throw new CHttpException(404,'Unable to resolve the request' . $route);
	}
}
