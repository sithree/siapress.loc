<?php

$comment = 1; //(date("H") >= 21 or date("H") < 6) ? 0 : 1;
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Новости Сургута и Югры, пресс-релизы, официальная информация. СИА-ПРЕСС',
    'language' => 'ru_RU',
    'timeZone' => 'Asia/Yekaterinburg',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap', // preload the bootstrap component
    ),
    'behaviors' => array(
        'runEnd' => array(
            'class' => 'application.behaviors.WebApplicationEndBehavior',
        ),
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendors.*',
        'ext.eoauth.*',
        'ext.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
        'ext.yiidebugtb.*', //our extension
        'application.modules.poll.models.*',
        'application.modules.poll.components.*',
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
        'poll' => array(
            // Restrict anonymous votes by IP address,
            // otherwise it's tied only to user_id
            'ipRestrict' => FALSE
        ),
    ),
    // application components
    'components' => array(
        'banner1' => array(
            'class' => 'components.main.banner',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            #'loginUrl' => array('user/login2'),
            'guestName' => 'Гость',
        #'returnUrl' => array('user/login'),
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
                'vkontakte' => array(
                    // регистрация приложения: http://vkontakte.ru/editapp?act=create&site=1
                    'class' => 'CustomVKontakteService',
                    'client_id' => '3226565',
                    'client_secret' => 'J7ubybqNdSHRJgkl94Mg',
                ),
            ),
        ),
        'simpleImage' => array(
            'class' => 'application.extensions.simpleimage.CSimpleImage',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=siapress',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'mysql',
            'charset' => 'utf8',
            'tablePrefix' => 'sia_',
            'queryCacheID' => 'cache',
            'queryCachingDuration' => 3600,
            'schemaCachingDuration' => 3600,
            // включаем профайлер
            'enableProfiling' => true,
            // показываем значения параметров
            'enableParamLogging' => true,
            'initSQLs' => array('SET time_zone ="+06:00"'),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'cache' => array(
            'class' => 'system.caching.CDummyCache',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CProfileLogRoute',
                    'levels' => 'profile',
                    'enabled' => true,
                ),
            ),
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
        // 'connectionID' => 'db',
        ),
    ),
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'adminbank@mail.ru',
        'comments' => $comment,
        'autopublishcomment' => 1,
        'showBanner' => true,
        'cacheExpire' => 180,
        'cacheExpireLong' => 600,
    ),
);
