<?php



return CMap::mergeArray(
                require_once(dirname(__FILE__) . '/main.php'), array(
            // application components
            'components' => array(
                'urlManager' => array(
                    'urlFormat' => 'path',
                    'showScriptName' => false,
                    'rules' => array(
                        #'site/<id:\d+>'=>'view',
                        #'<action:(login|logout)>' => 'site/<action>',
                        #'site/<action:\w+>'=>'<action>',
                        'sitemap.xml' => 'site/sitemapxml',
                        'sitemap_news.xml' => 'site/sitemapnewsxml',
                        'login' => 'site/login',
                        'registration' => 'site/registration',
                        'logout' => 'site/logout',
                        'rules' => 'site/rules',
                        'search' => 'site/search',
                        'authors' => 'users/index',
                        'click' => 'click/index',
                        'online/pp/<city:\w+>' => 'site/pp',
                        'official/gazprom_sgt' => 'news/view/id/23533', #array('news/opinion/<id:22>'),
                        #'news' => 'news/index',
                        #'opinion' => 'news/index?category=opinion',
                        '<category:\w+>/item/<id>' => 'old/view',
                        'news/<category:\w+>' => 'news/index',
                        'news/<category:\w+>/<id:\d+>' => 'news/view',
                        'blogs/<id:\d+>' => 'blogs/view',
                        'opinion/<id:\d+>' => 'opinion/view',
                    #'<controller:\w+>/<id:\d+>' => '<controller>/view',
                    #'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    #'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    #'http://login.sia3.ru:88/' => 'site/login',
                    ),
                ),
                'bootstrap' => array(
                    'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                    'enableJS' => true,
                    'coreCss' => false,
                    'responsiveCss' => false,
                    'yiiCss' => false,
                ),
            ),
                )
);
?>
