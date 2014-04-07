<?php

ini_set('error_reporting', "E_ALL");
error_reporting(E_STRICT);
ini_set('display_errors', 'On');

$yii = dirname(__FILE__) . '/../framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/frontend.php';

// включать дебаг?
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);


// подключаем фреймворк
require_once($yii);
// стартуем приложение с помощью нашего WebApplicaitonEndBehavior, указав ему, что нужно загрузить фронтенд
Yii::createWebApplication($config)->runEnd('front');

