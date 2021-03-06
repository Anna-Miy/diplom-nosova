<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(

        'admin',

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			/*'ipFilters'=>array('127.0.0.1','::1'),*/
		),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
      
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
            'showScriptName' => false,
            'caseSensitive'=>true, // this is important
		),

		// uncomment the following to use a MySQL database

//		'db'=>array(
//			'connectionString' => 'mysql:host=localhost;dbname=denwer_diplom',
//			'emulatePrepare' => true,
//			'username' => 'root',
//			'password' => '1',
//			'charset' => 'utf8',
//		),

        'db'=>array(
            'connectionString' => 'mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_122125dfaffaa8f',
            'emulatePrepare' => true,
            'username' => 'bbda253b9e4f82',
            'password' => 'a50796ab',
            'charset' => 'utf8',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				/*
				array(
					'class'=>'CWebLogRoute', 'levels'=>'trace, info, error, warning', 'categories' => 'system.db.*,application.models.*'
				),*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);


