<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Registro Único Nacional de Colecciones Biológicas',
	'charset'=>'utf-8',
	
	// Bootstrap configuration
	//'theme'=>'bootstrap', // requires you to copy the theme under your themes directory

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),
		
	'language'=>'es', // Este es el lenguaje predeterminado de la aplicaci�n
	'sourceLanguage'=>'en', //  Lenguaje predeterminado de los archivos

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.yii-mail.YiiMailMessage',
		'ext.tcpdf.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'h4s1p8k2',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
					'bootstrap.gii',
			),
		),
	),

	// application components
	'components'=>array(
		'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType' => 'smtp',
			'transportOptions' => array(
				'host' => 'smtp.gmail.com',
				'username'=>'rnc@humboldt.org.co',
				'password'=>'rnc2015.',
				'port'=>'465',
				'encryption' => 'ssl'
			),
			'viewPath' => 'application.views.mail',
		),
		'Date' => array(
				'class'=>'application.components.Date',
				//And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
				'offset' => -5,
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
			'class' => 'WebUser',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'showScriptName'=>false,
			'rules'=>array(
				'ficha/<id:\d+>/<title:.*?>'=>'ficha/view',
				'fichas/<tag:.*?>'=>'ficha/index',
				'fichas/carrusel/<tag:.*?>'=>'ficha/carrusel',
				// REST patterns
				array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
				array('api/carrusel', 'pattern'=>'api/fichas/<model:\w+>', 'verb'=>'GET'),
				array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				
			),
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a Postgres database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;port=3306;dbname=rnc_db_5',
			//'connectionString' => 'mysql:host=54.81.3.23;port=3306;dbname=rnc_db',
			//'username' => 'lgrajales',
			//'password' => 'Lg2013-',
			//'emulatePrepare' => true,
			'username' => 'root', //actualizar usuario
			'password' => '', //actualizar password
			'charset' => 'utf8',
			'emulatePrepare' => false,
			'enableProfiling'=>true,
			'enableParamLogging'=>true,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace, profile, info',
				),*/
				/*array(
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					'levels'=>'error, warning, trace, profile, info',
					'ipFilters'=>array('127.0.0.1'),
				),*/
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning, trace, profile, info',
				),*/
			),
		),
		/*'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
		),*/
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
			'responsiveCss'=>true,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'hescobar@humboldt.org.co',
	),
);