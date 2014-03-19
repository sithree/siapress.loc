<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Новости Сургута и Югры - СИА-ПРЕСС',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap', // preload the bootstrap component
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendors.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
        'ext.yiidebugtb.*', //our extension
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii', // since 0.9.1
            ),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            'enableJS' => true,
            'coreCss' => true,
            'responsiveCss' => true,
        ),
        'loid' => array(
            //провыерить, нужен ли он вообще
            'class' => 'ext.lightopenid.loid',
        ),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Использовать всплывающее окно вместо перенаправления на сайт провайдера
            'services' => array(// Вы можете настроить список провайдеров и переопределить их классы
                'facebook' => array(
                    // регистрация приложения: https://developers.facebook.com/apps/
                    'class' => 'FacebookOAuthService',
                    'client_id' => '2995169',
                    'client_secret' => 'GNYC50J5irk52tLUxMQl',
                ),
                'vkontakte' => array(
                    // регистрация приложения: http://vkontakte.ru/editapp?act=create&site=1
                    'class' => 'VKontakteOAuthService',
                    'client_id' => '2995169',
                    'client_secret' => 'GNYC50J5irk52tLUxMQl',
                ),
                'twitter' => array(
					// регистрация приложения: https://dev.twitter.com/apps/new
					'class' => 'TwitterOAuthService',
					'key' => 'DcJfEHUE5zjoPtBm1hsAA',
					'secret' => '2i9CQEAyZFOCmswhHgl29Kza9QteQZWr8TXWKHaodiI',
				),
            ),
        ),
        'simpleImage' => array(
            'class' => 'application.extensions.simpleimage.CSimpleImage',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                #'site/<id:\d+>'=>'view',
                #'<action:(login|logout)>' => 'site/<action>',
                #'site/<action:\w+>'=>'<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            #'http://login.sia3.ru:88/' => 'site/login',
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=sia3',
            'emulatePrepare' => false,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'sia_',
            'queryCacheID' => 'cache',
            'queryCachingDuration' => 3600,
            // включаем профайлер
            'enableProfiling' => true,
            // показываем значения параметров
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
            #'duration' => '50',
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'adminbank@mail.ru',
    ),
);