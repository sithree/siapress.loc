<!DOCTYPE html>
<html lang="ru"  xmlns:og="http://ogp.me/ns#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" />
        <!-- Le styles -->

        <?php echo $this->getMetaProperty(); ?>
        <meta name="google-site-verification" content="o6O0JpTfyv-GyBqTFgVREC4zxXwukjIN3mEMLKJY3i4" />
        <meta name="229962aa5cb18d18191965311d4422ec" content="">
        <meta name="wot-verification" content="1dff145b2373cca16a3f"/>


        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/newTemplate.css" />-->
        <link rel="apple-touch-icon" href="touch-icon-iphone.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone-retina.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="touch-icon-ipad-retina.png" />
        <!--[if IE]>
        <!--[if gte IE 9]>
          <style type="text/css">
            .gradient {
               filter: none;
            }
          </style>
        <![endif]-->

        <style>
            .navbar-inner {
                padding-left: 8px;
                padding-right: 8px;
                font-weight:440;
                font-size:99%;
            }
        </style>
        <![endif]-->
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
           <style>
        .navbar-inner {
        padding-left: 10px;
        padding-right: 10px;
        }
        #social-menu {
            display: none;
        }
        </style>

          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-21444679-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>

        <style type="text/css">
            body {
                padding: 0 0 15px 0;
            }
            .container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
                width: 1170px;
            }
            .container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
                width: 1170px;
            }
            .span12 {
                width: 1170px;
            }
            .span11 {
                width: 1070px;
            }
            .span10 {
                width: 970px;
            }
            .span9 {
                width: 870px;
            }
            .span8 {
                width: 770px;
            }
            .span7 {
                width: 670px;
            }
            .span6 {
                width: 570px;
            }
            .span5 {
                width: 470px;
            }
            .span4 {
                width: 370px;
            }
            .span3 {
                width: 270px;
            }
            .span2 {
                width: 170px;
            }
            .span1 {
                width: 70px;
            }
            .navbar .nav > li > a {
                padding: 11px 7px 10px;
            }
        </style>
        <!-- Вектор подписаться -->
        <script type='application/ld+json'>
            {
            "@context":"http://schema.org",
            "@type" : "SubscribeAction",
            "url" : "http://pay.siapress.ru/",
            "name": "Подписаться",
            "image": "http://www.siapress.ru/favicon.ico",
            "description": "Подписаться на газету Новый Город"
            }
        </script>

    </head>
    <?php
    //Добавляем код кнопки наверх
    Yii::app()->getClientScript()->registerScript('toptop', "
                $('a#back-top').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 500); // скорость прокрутки
                    return false;
                });

                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) // количество прокрученных пикселей, после которых начинает отображаться кнопка вверх на сайте.
                                {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });
        ");
    ?>
    <body>
        <div class="container">
            <div id="rontar_adplace_3948"></div>
            <script type="text/javascript"><!--

                (function(w, d, n) {
                    var ri = {rontar_site_id: 1717, rontar_adplace_id: 3948, rontar_place_id: 'rontar_adplace_3948', adCode_rootUrl: 'http://adcode.rontar.com/'};
                    w[n] = w[n] || [];
                    w[n].push(
                            ri
                            );
                    var a = document.createElement('script');
                    a.type = 'text/javascript';
                    a.async = true;
                    a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
                    var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
                    b.parentNode.insertBefore(a, b);
                })(window, document, 'rontar_ads');
//--></script>

        </div>
        <br />

        <div class="container" style="position:relative;  padding:0 15px;">
            <div class="toptop">
                <a id="back-top" href="#" title="К началу страницы">Наверх</a>
            </div>
            <div class="container mbottom" style="position:relative;"><!-- Шапка сайта -->

                <div class="row">
                    <div class="span3" style="position: relative;"><!-- Лого и погода -->
                        <div class="logo">
                            <a href="/" style="display: block; width: 182px; height:42px; float:left; margin-right: 25px; margin-top:-13px">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="СИА-ПРЕСС логотип"  />
                            </a>
                            <div style="position: absolute; left: 185px; top: -20px; color: #ca0000; font-size: 14px; font-weight:bold;background: #ca0000;color: white;padding: 1px 4px;border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;z-index: 999;">12+</div>
                        </div>
                    </div><!-- // Лого и погода -->

                    <div class="span9 right"><!-- Авторизация -->
                        <?php if (!Yii::app()->user->isGuest) : ?>
                            Здравствуйте,  <b><?php echo Yii::app()->user->name ?></b><br />
                            <?php
                            if (Yii::app()->user->checkAccess('official') or Yii::app()->user->checkAccess('author'))
                                echo "<a href='admin.php?r=article/new'>Новый блог</a>&nbsp;&nbsp;";
                            ?>
                            <?php
                            if (Yii::app()->user->checkAccess('administrator') or Yii::app()->user->checkAccess('author_sia'))
                                echo "<a href='admin.php'>Админка</a>&nbsp;&nbsp;";
                            ?>
                            <a href="logout">Выход</a>
                        <?php else: ?>
                            <?php
                            $this->widget('bootstrap.widgets.BootButton', array(
                                'label' => 'Представьтесь',
                                'url' => '#myModal',
                                'type' => 'danger',
                                'htmlOptions' => array('data-toggle' => 'modal'),
                            ));
                            ?>
                            <!--                                <a href="login" data-target="#myModal" data-toggle="modal">Представьтесь</a>-->
                        <?php
                        #echo CHtml::link('Авторизация', array('site/login'), array('class' => 'btn btn-danger'));
                        endif;
                        ?>
                        <?php #Yii::app()->user->logout();  ?>

                    </div><!-- // Авторизация -->
                </div>
            </div><!-- // Шапка сайта -->
            <?php $this->widget('application.components.main.bloggers'); ?>
            <div class="container"><!-- Основная навигация -->
                <div class="row">
                    <div class="span12">
                        <?php
                        $this->widget('bootstrap.widgets.BootNavbar', array(
                            'fixed' => false,
                            'brand' => false,
                            'brandUrl' => false,
                            'collapse' => true, // requires bootstrap-responsive.css
                            'items' => array(
                                array(
                                    'class' => 'bootstrap.widgets.BootMenu',
                                    'items' => array(
                                        array('label' => 'Новости', 'items' => array(
                                                array('label' => 'Политика', 'url' => array('news/index', 'category' => 'politics'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'politics'
                                                ),
                                                array('label' => 'Экономика', 'url' => array('news/index', 'category' => 'economics'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'economics'),
                                                array('label' => 'Общество', 'url' => array('news/index', 'category' => 'society'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'society'),
                                                array('label' => 'Происшествия', 'url' => array('news/index', 'category' => 'incident'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'incident'),
                                                array('label' => 'Спорт', 'url' => array('news/index', 'category' => 'sport'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'sport'),
                                                array('label' => 'Культура', 'url' => array('news/index', 'category' => 'life'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'life'),
                                                array('label' => 'Здоровье', 'url' => array('news/index', 'category' => 'health'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'health'),
                                                array('label' => 'Официально', 'url' => array('news/index', 'category' => 'official'),
                                                    'active' => @Yii::app()->controller->actionParams['category'] == 'official'),
                                            )),
                                        array('label' => 'Мнения', 'url' => array('news/index', 'category' => 'opinion'),
                                            'active' => @Yii::app()->controller->action->id == 'opinion',),
//                array('label' => 'Слухи', 'url' => array('news/index', 'category' => 'noise'),
//                    'active' => @Yii::app()->controller->actionParams['category'] == 'noise'),
                                        array('label' => 'О чем говорят?', 'url' => array('news/index', 'category' => 'say'),
                                            'active' => @Yii::app()->controller->actionParams['category'] == 'say'),
                                        array('label' => 'Публичные лекции', 'url' => array('news/index', 'category' => 'lections'),
                                            'active' => @Yii::app()->controller->actionParams['category'] == 'lections'),
                                        array('label' => 'Задай вопрос', 'url' => array('news/index', 'category' => 'query'),
                                            'active' => @Yii::app()->controller->actionParams['category'] == 'query'),
                                        array('label' => 'Авто', 'url' => array('news/index', 'category' => 'auto'),
                                            'active' => @Yii::app()->controller->actionParams['category'] == 'auto'),
                                        array('label' => 'Недвижимость', 'url' => array('news/index', 'category' => 'realty'), 'encodeLabel' => false,
                                            'active' => @Yii::app()->controller->actionParams['category'] == 'realty'),
                                        array('label' => 'Карта', 'url' => array('site/pp', 'city' => 'surgut')),
                                        array('label' => '<span style="color:yellow">Операция: "Подъезд!"</span>', 'url' => array('site/rupor'), 'encodeLabel' => false),
                                    /*
                                      array('label' => 'Новости', 'items' => array(
                                      array('label' => 'Политика', 'url' => array('news/politics')),
                                      array('label' => 'Экономика', 'url' => array('news/economics')),
                                      array('label' => 'Общество', 'url' => array('news/society')),
                                      array('label' => 'Мегаполис', 'url' => array('news/megapolis')),
                                      array('label' => 'Происшествия', 'url' => array('news/incident')),
                                      array('label' => 'Спорт', 'url' => array('news/sport')),
                                      array('label' => 'Культура', 'url' => array('news/life')),
                                      '-',
                                      array('label' => 'Все новости', 'url' => array('')),
                                      )),
                                      array('label' => 'Пресс-релизы', 'url' => array('official/index')),
                                      array('label' => 'Блоги', 'url' => array('blogs/index')),
                                      array('label' => 'Мнения', 'url' => array('opinion/index')),
                                      array('label' => 'Слухи', 'url' => array('official/index')),
                                      array('label' => 'Экслюзив', 'items' => array(
                                      array('label' => 'Фоторепортажи', 'url' => array('news/politics')),
                                      array('label' => 'Интервью', 'url' => array('news/politics')),
                                      )),
                                      array('label' => 'Спецпроекты', 'items' => array(
                                      array('label' => 'К ответу!', 'url' => array('news/politics')),
                                      array('label' => 'Конкурс', 'url' => array('news/politics')),
                                      )),
                                     *

                                      array('label' => 'Новости компаний', 'url' => array('official/index')), */
                                    ),
                                ),
                                '<noindex><ul class="nav pull-right" id="social-menu" style="margin-left:0px;">
<li><a href="/search">Поиск</a></li>
<li>&nbsp;</li>
<li><a style="background: url(images/icons/rss32.png) no-repeat center center" href="/rss">&nbsp;</a></li>
                                    <li><a rel="nofollow" target="_blank" style="background: url(images/icons/f.png) no-repeat center center" href="http://www.facebook.com/siapress">&nbsp;</a></li>
                                    <li><a rel="nofollow" target="_blank" style="background: url(images/icons/b.png) no-repeat center center" href="http://vkontakte.ru/siapress">&nbsp;</a></li>
                                    <li><a rel="nofollow" target="_blank" style="background: url(images/icons/t.png) no-repeat center center" href="http://twitter.com/#!/siapress">&nbsp;</a></li>


                                </ul></noindex>
                        <form action="" class="navbar-search pull-right nav-search-form" style="display:none;">
                            <input id="q" type="text" placeholder="Поиск по сайту" class="search-query span2" />
                        </form>',
                            ),
                        ));
                        ?>
                    </div>
                </div>
            </div><!-- // Основная навигация -->
