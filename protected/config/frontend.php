<?php

return CMap::mergeArray(
                require_once(dirname(__FILE__) . '/main.php'), array(
            // application components
            'components' => array(
//                'clientScript' => array(
//                    'class' => 'ext.NLSClientScript.NLSClientScript',
//                    //'excludePattern' => '/\.tpl/i', //js regexp, files with matching paths won't be filtered is set to other than 'null'
//                    //'includePattern' => '/\.php/', //js regexp, only files with matching paths will be filtered if set to other than 'null'
//                    'mergeJs' => false, //def:true
//                    'compressMergedJs' => false, //def:false
//                    'mergeCss' => true, //def:true
//                    'compressMergedCss' => true, //def:false
//                    #'serverBaseUrl' => 'http://cdn.si3.ru', //can be optionally set here
//                    'mergeAbove' => 1, //def:1, only "more than this value" files will be merged,
//                    'curlTimeOut' => 5, //def:5, see curl_setopt() doc
//                    'curlConnectionTimeOut' => 10, //def:10, see curl_setopt() doc
//                    'appVersion' => 1.1 //if set, it will be appended to the urls of the merged scripts/css
//                ),

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
                        'rss' => 'rss/index',
                        'authors' => 'users/index',
                        'click' => 'click/index',
                        'polls' => 'poll/poll/index',
                        'polls/view' => 'poll/poll/view',
                        'online/pp/<city:\w+>' => 'site/pp',
                        'official/gazprom_sgt' => 'news/view/id/23533', #array('news/opinion/<id:22>'),
                        #'news' => 'news/index',
                        #'opinion' => 'news/index?category=opinion',
                        #
                        //Для всего остального есть общий ArticleController
//                        'ajax/<category:\w+>' => 'article/view',
                        'themes/<id:\d+>' => 'themes/index',
                        'poll/<controller:\w+>' => 'poll/<controller>',
                        'poll/<controller:\w+>/<action:\w+>' => 'poll/<controller>/<action>',
//                        'online' => array('article/index', array('category' => 'online')),
//                        'news/all/<page>/<id:\d+>' => 'article/index',
                        '<category:\w+>/<id:\d+>' => 'article/view',
                        '<category:\w+>' => 'article/index',
                        'news/all' => 'article/index',
                        // ---
                        'news/send' => 'news/send',
                        'news/sended' => 'news/sended',
                        'ajax/likearticle' => 'ajax/likearticle',
                        '<category:\w+>/item/<id>' => 'old/view',
//                        'news/<category:\w+>' => 'article/index',
//                        'news/<category:\w+>/<id:\d+>' => 'news/view',
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
