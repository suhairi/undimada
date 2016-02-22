<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistem Undimaya',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'mygii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('219.92.23.64','127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'cache'=>array(
			'class'=>'system.caching.CFileCache',
		),
		'settings'=>array(
			'class'=>'CmsSettings',
			'cacheComponentId'=>'cache',
			'cacheId'=>'global_website_settings',
			'cacheTime'=>84000,
			'tableName'=>'settings',
			'dbComponentId'=>'db',
			'createTable'=>true,
			'dbEngine'=>'InnoDB',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'admin'=>'Elections/index',
			),
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		'ePdf' => array(
			'class'         => 'ext.yii-pdf.EYiiPdf',
			'params'        => array(
				'mpdf'     => array(
					'librarySourcePath' => 'application.vendors.mpdf.*',
					'constants'         => array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
				/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
					'mode'              => '', //  This parameter specifies the mode of the new document.
					'format'            => 'A4', // format A4, A5, ...
					'default_font_size' => 0, // Sets the default document font size in points (pt)
					'default_font'      => '', // Sets the default font-family for the new document.
					'mgl'               => 15, // margin_left. Sets the page margins for the new document.
					'mgr'               => 15, // margin_right
					'mgt'               => 16, // margin_top
					'mgb'               => 16, // margin_bottom
					'mgh'               => 9, // margin_header
					'mgf'               => 9, // margin_footer
					'orientation'       => 'P', // landscape or portrait orientation
				)*/
				),
			),
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=undimaya',
			'emulatePrepare' => true,
			'username' => 'undimaya',
			'password' => 'undimaya123',
			'charset' => 'utf8',
			'enableParamLogging' => true,
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
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
					'showInFireBug'=>true,
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'adminUrl'=>'128.199.179.112',
	),

);
