<?php
/**
 *
 * common.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
return array(
	'basePath' => realPath(__DIR__ . '/..'),
	'preload' => array('log'),
	'aliases' => array(
		'vendor' => 'application.vendor',
	),
	'import' => array(
		'application.controllers.*',
		'application.components.*',
		'application.extensions.components.*',
		'application.extensions.behaviors.*',
		'application.helpers.*',
		'application.models.*',
		'vendor.2amigos.yiistrap.helpers.*',
		'vendor.2amigos.yiiwheels.helpers.*',
        'application.modules.movie.models.*'
	),

    'modules' => array(
        'movie',
        ),
	'components' => array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=',
		    	'username' => '',
		 	   'password' => '',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
				array(
					'class'        => 'CFileLogRoute',
					'levels'       => 'error, warning',
				),
			),
		),
	),
	'params' => array(

		// php configuration
		'php.defaultCharset' => 'utf-8',
		'php.timezone'       => 'UTC',
        'api.server' => 'http://vacancy.dev.telehouse-ua.net',
        'wwwPath' => realPath(__DIR__ . '/../../www')
	)
);
