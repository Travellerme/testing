<?php


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    	
	
	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		
		'authManager' => array(
			// Будем использовать свой менеджер авторизации
			'class' => 'PhpAuthManager',
			// Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
			'defaultRoles' => array('guest'),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=Traveller',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'whglnintb3584',
			'charset' => 'utf8',
		),
		
				
	),


);
