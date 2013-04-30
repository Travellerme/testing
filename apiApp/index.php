<?php

// change the following paths if necessary
$api=dirname(__FILE__).'/../api/Api.php';
$config=dirname(__FILE__).'/application/config/main.php';


define('API_DEBUG',true);
try 
{
	require_once($api);
	Api::createWebApp($config)->run();

} 
catch (Exception $e) 
{
	echo $e->getMessage(), "\n";
}

