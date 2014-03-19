<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" />
        <!-- Le styles -->
        <style type="text/css">
            body {
                padding-top: 0px;
                padding-bottom: 15px;
            }
        </style>

        <?php echo $this->getMetaProperty(); ?>
        <meta name="google-site-verification" content="o6O0JpTfyv-GyBqTFgVREC4zxXwukjIN3mEMLKJY3i4" />
        <meta name="229962aa5cb18d18191965311d4422ec" content="">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

        <!--[if IE]>

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
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

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
 
    (function (w, d, n) {
        var ri = { rontar_site_id: 1717, rontar_adplace_id: 3948, rontar_place_id: 'rontar_adplace_3948', adCode_rootUrl: 'http://adcode.rontar.com/' };
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

        <div class="container" style="position:relative;">
            <div class="toptop">
                <a id="back-top" href="#" title="К началу страницы">Наверх</a>
            </div>
            <div class="container mbottom" style="position:relative;"><!-- Шапка сайта -->

                <div class="row">
                    <div class="span3" style="position: relative;"><!-- Лого и погода -->
                        <div class="logo">
                            <a href="/" style="display: block; width: 181px; height:42px; float:left; margin-right: 25px;">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="СИА-ПРЕСС логотип"  />
                            </a>
                            <div style="position: absolute; left: 185px; top: 5px; color: #ca0000; font-size: 14px; font-weight:bold;background: #ca0000;color: white;padding: 1px 4px;border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;z-index: 999;">12+</div>
                            <div style="position:absolute; font-weight: bold; font-style: italic;left: 190px;
                                 position: absolute;
                                 top: -10px;">beta</div>
                        </div>
                    </div><!-- // Лого и погода -->
                    <div class="span6" style="font-size:90%; color:#999;">

                        Обращаем ваше внимание, что сайт находится в режиме бета-тестирования и ограниченного функционирования. По всем замеченным ошибкам и с предложениями просьба обращаться по адресу <a href="mailto:error@siapress.ru">error@siapress.ru</a>                        </div>

                     <div class="span3 right"><!-- Авторизация -->
                        <div class="row-fluid">
                            <?php if (!Yii::app()->user->isGuest) : ?>
                                <div class="span4">&nbsp; </div>

                                <div class="span8 ">
                                    <img style="float:left;" src="<?php echo Users::model()->getAvatarFilename(50, false,Yii::app()->user->id);?>" alt="<?php echo Yii::app()->user->name ?>" />
                                    <b><?php echo Yii::app()->user->name ?></b>
                                    <span><?php #echo Yii::app()->user->username ?></span>
                                    <a href="logout">Выход</a>
                                </div>
                            <?php else: ?>
                                <?php
                                /*
                                $this->widget('bootstrap.widgets.BootButton', array(
                                    'label' => 'Авторизация на сайте',
                                    'url' => '#myModal',
                                    'type' => 'danger',
                                    'htmlOptions' => array('data-toggle' => 'modal'),
                                ));
                                 *
                                 */
                                ?>
                                <a href="login">Авторизация</a> / <a href="registration">Регистрация</a>
                                <?php
                                #echo CHtml::link('Авторизация', array('site/login'), array('class' => 'btn btn-danger'));
                            endif;
                            ?>
                            <?php #Yii::app()->user->logout();  ?>
                        </div>

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
                                        array('label' => 'Мнения', 'url' => array('news/index', 'category' => 'opinion'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'opinion'),
                                        array('label' => 'Слухи', 'url' => array('news/index', 'category' => 'noise'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'noise'),
                                        array('label' => 'Политика', 'url' => array('news/index', 'category' => 'politics'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'politics'
                                        ),
                                        array('label' => 'Экономика', 'url' => array('news/index', 'category' => 'economics'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'economics'),
                                        array('label' => 'Общество', 'url' => array('news/index', 'category' => 'society'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'society'),
                                        array('label' => 'Происшествия', 'url' => array('news/index', 'category' => 'incident'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'incident'),
                                        array('label' => 'Спорт', 'url' => array('news/index', 'category' => 'sport'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'sport'),
                                        array('label' => 'Культура', 'url' => array('news/index', 'category' => 'life'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'life'),
                                        array('label' => 'Здоровье', 'url' => array('news/index', 'category' => 'health'),
                                            'active' => Yii::app()->controller->actionParams['category'] == 'health'),
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
                                  <li><a target="_blank" href="http://pay.siapress.ru">Подписка 2013</a></li>
<li><a rel="nofollow" class="nav-search-btn" href="/search"><i class="icon-search icon-white"></i> </a></li>
<li><a style="background: url(images/icons/rss32.png) no-repeat center center" href="http://feeds.feedburner.com/siapress" target=_blank>&nbsp;</a></li>
                                    <li><a rel="nofollow" target="_blank" style="background: url(images/icons/f.png) no-repeat center center" href="http://www.facebook.com/siapress">&nbsp;</a></li>
                                    <li><a rel="nofollow" target="_blank" style="background: url(images/icons/b.png) no-repeat center center" href="http://www.vk.com/siapress">&nbsp;</a></li>
                                    <li><a rel="nofollow" target="_blank" style="background: url(images/icons/t.png) no-repeat center center" href="http://www.twitter.com/siapress">&nbsp;</a></li>


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
            <?php $this->widget('application.components.main.mbanner', array('position' => 13)); ?>