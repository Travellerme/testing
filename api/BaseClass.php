<?php

defined('API_PATH') or define('API_PATH',dirname(__FILE__));

class BaseClass
{
	private static $_app;
		
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
			include(YII_PATH.self::$_coreClasses[$className]);
		
		return true;
	}
	
	private static $_coreClasses=array(
		'BaseApplication' => '/base/BaseApplication.php',
		'Component' => '/base/Component.php',
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

