<?php

defined('API_PATH') or define('API_PATH',dirname(__FILE__));
defined('API_ENABLE_EXCEPTION_HANDLER') or define('API_ENABLE_EXCEPTION_HANDLER',true);
defined('API_ENABLE_ERROR_HANDLER') or define('API_ENABLE_ERROR_HANDLER',true);

class BaseClass
{
	private static $_app;
	private static $_aliases=array('system'=>API_PATH);
	public static $classMap=array();
	
	public static function createWebApp($config=null)
	{
		return self::createApp('WebApplication',$config);
	}
	
	public static function createApp($class,$config=null)
	{
		return new $class($config);
	}
	
	public static function app()
	{
		return self::$_app;
	}
	
	public static function setPathOfAlias($alias,$path)
	{
		if(empty($path))
			unset(self::$_aliases[$alias]);
		else
			self::$_aliases[$alias]=rtrim($path,'\\/');
	}
	
	public static function setApp($app)
	{
		if(self::$_app===null || $app===null)
			self::$_app=$app;
		else
			throw new Exception('Api application can only be created once.');
	}
	
	/**
	 * @return string the path of the api
	 */
	public static function getApiPath()
	{
		return API_PATH;
	}
	
	public static function autoload($className)
	{
		
		if(isset(self::$classMap[$className]))
			include(self::$classMap[$className]);
		elseif(isset(self::$_coreClasses[$className]))
			include(API_PATH.self::$_coreClasses[$className]);
		
		return true;
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
			throw new Exception('Object configuration must be an array containing a "class" element.');

		if(!class_exists($type))
			throw new Exception('Class "' . $type . '" does not exist');
			

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
				throw new Exception('Too much arguments for class ' . $type);
			}
		}
		else
			$object=new $type;

		foreach($config as $key=>$value)
			$object->$key=$value;

		return $object;
	}
	
	private static $_coreClasses=array(
		'BaseApplication' => '/base/BaseApplication.php',
		'Component' => '/base/Component.php',
		'AppComponent' => '/base/AppComponent.php',
		'Model' => '/base/Model.php',
		'Module' => '/base/Module.php',
		'DbManager' => '/db/DbManager.php',
		'BaseController' => '/web/CBaseController.php',
		'HttpCookie' => '/web/HttpCookie.php',
		'HttpRequest' => '/web/HttpRequest.php',
		'HttpSession' => '/web/HttpSession.php',
		'UrlManager' => '/web/UrlManager.php',
		'WebApplication' => '/web/WebApplication.php',
		'Action' => '/web/actions/Action.php',
		'InlineAction' => '/web/actions/InlineAction.php',
	);
}
spl_autoload_register(array('BaseClass','autoload'));

