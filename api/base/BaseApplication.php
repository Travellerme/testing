<?php
abstract class BaseApplication extends Module
{
	public $charset='UTF-8';
	
	private $_id;
	private $_basePath;
	private $_homeUrl;

	
	abstract public function processRequest();
	
	public function __construct($config=null)
	{
		Api::setApp($this);

		// set basePath at early as possible to avoid trouble
		if(is_string($config))
			$config=require($config);
		if(isset($config['basePath']))
		{
			$this->setBasePath($config['basePath']);
			unset($config['basePath']);
		}
		else
			$this->setBasePath('application');
		Api::setPathOfAlias('application',$this->getBasePath());
		Api::setPathOfAlias('webroot',dirname($_SERVER['SCRIPT_FILENAME']));

		//$this->initSystemHandlers();
		$this->registerCoreComponents();
	
		$this->configure($config);
		
	}
	
	public function run()
	{
		$this->processRequest();
	}
	
	public function getRequest()
	{
		return $this->getComponent('request');
	}
	
	/**
	 * Returns the URL manager component.
	 * @return UrlManager the URL manager component
	 */
	public function getUrlManager()
	{
		return $this->getComponent('urlManager');
	}

	
	protected function initSystemHandlers()
	{
		if(YII_ENABLE_EXCEPTION_HANDLER)
			set_exception_handler(array($this,'handleException'));
		if(YII_ENABLE_ERROR_HANDLER)
			set_error_handler(array($this,'handleError'),error_reporting());
	}
	
	public function setBasePath($path)
	{
		if(($this->_basePath=realpath($path))===false || !is_dir($this->_basePath))
			throw new Exception('Application base path' . $path . 'is not a valid directory.');
	}
	
	protected function registerCoreComponents()
	{
		$components=array(
			'coreMessages'=>array(
				//'class'=>'CPhpMessageSource',
				//'language'=>'en_us',
				'basePath'=>API_PATH.DIRECTORY_SEPARATOR.'messages',
			),
			'db'=>array(
				'class'=>'DbManager',
			),
			'urlManager'=>array(
				'class'=>'UrlManager',
			),
			'request'=>array(
				'class'=>'HttpRequest',
			),
		);

		$this->setComponents($components);
	}
	
	public function getBasePath()
	{
		return $this->_basePath;
	}
	
	
}
