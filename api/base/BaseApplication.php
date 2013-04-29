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
		
		$this->init();
	}
	
	public function run()
	{
		$this->processRequest();
	}
	
	public function getRequest()
	{
		return $this->getComponent('request');
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
			throw new CException('Application base path' . $path . 'is not a valid directory.');
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
	
	public static function createComponent($config)
	{
		if(is_string($config))
		{
			$type=$config;
			$config=array();
		}
		elseif(isset($config['class']))
		{
			$type=$config['class'];
			unset($config['class']);
		}
		else
			throw new CException('Object configuration must be an array containing a "class" element.');

		if(!class_exists($type,false))
			throw new CException('Class ' . $type . 'does not exist');
			

		if(($n=func_num_args())>1)
		{
			$args=func_get_args();
			if($n===2)
				$object=new $type($args[1]);
			elseif($n===3)
				$object=new $type($args[1],$args[2]);
			elseif($n===4)
				$object=new $type($args[1],$args[2],$args[3]);
			else
			{
				throw new CException('Too much arguments for class ' . $type);
			}
		}
		else
			$object=new $type;

		foreach($config as $key=>$value)
			$object->$key=$value;

		return $object;
	}
}
