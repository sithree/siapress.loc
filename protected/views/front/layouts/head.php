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

        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>



        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/template.css" />


        <link rel="apple-touch-icon" href="/img/touch-icon-iphone.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/img/touch-icon-ipad.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/img/touch-icon-iphone-retina.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/img/touch-icon-ipad-retina.png" />
        <!--[if IE]>
        <!--[if gte IE 9]>
          <style type="text/css">
            .gradient {
               filter: none;
            }
          </style>
        <![endif]-->


        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.ico">



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
            <div class="toptop">
                <a id="back-top" href="#" title="К началу страницы">Наверх</a>
            </div>

            <header class="clearfix">
                <div class="row">
                    <div class="col-xs-3">
                        <div id="logotype">
                            <a href="/" title="На главную"><img width="211" height="50" src="img/logo.png" alt="Логотип Сиапресс" /></a>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <div id="top-blogs">
                            <div class="row">
                                <div class="col-xs-4">
                                    <a href="#">
                                        <img src="http://www.siapress.ru/images/users/blog/9.jpg" alt="">
                                        <div class="author">Олег Владимиров</div>
                                        <h2>Остров Крым</h2>
                                        <div class="stat"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>                                        
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="#">
                                        <img src="http://www.siapress.ru/images/users/blog/4.jpg" alt="">
                                        <div class="author">Дмитрий Щеглов</div>
                                        <h2>Имперский марш</h2>
                                        <div class="stat"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>                                        
                                    </a></div>
                                <div class="col-xs-4">
                                    <a href="#">
                                        <img src="http://www.siapress.ru/images/users/blog/3.jpg" alt="">
                                        <div class="author">Тарас Самборский</div>
                                        <h2>Анна-Ванна – наш отряд!</h2>
                                        <div class="stat"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>                                        
                                    </a>
                                </div>                             
                            </div>
                        </div>
                    </div>
                </div>


                <nav>
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'encodeLabel' => false,
                        'items' => array(
                            array('label' => 'Новости <i class="fa fa-angle-double-down"></i>', 'url' => array(''),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'linkOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'Политика', 'url' => array('#')),
                                    array('label' => 'Экономика', 'url' => array('/news/economics')),
                                    array('label' => 'Общество', 'url' => array('#')),
                                    array('label' => 'Происшествия', 'url' => array('#')),
                                    array('label' => 'Спорт', 'url' => array('#')),
                                    array('label' => 'Культура', 'url' => array('#')),
                                    array('label' => 'Здоровье', 'url' => array('#')),
                                    array('label' => 'Официально', 'url' => array('#'))
                                )),
                            array('label' => 'О чем говорят?', 'url' => array('#')),
                            array('label' => 'Он-лайн проекты <i class="fa fa-angle-double-down"></i>', 'url' => array('#'),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'linkOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'О чем говорят', 'url' => array('#')),
                                    array('label' => 'С чем едят', 'url' => array('#')),
                                    array('label' => 'Что пьют', 'url' => array('#')),
                                    array('label' => 'И далее по списку', 'url' => array('#'))
                                )),
                            array('label' => 'Старый Сургут &nbsp;<i class="fa fa-angle-double-down"></i>', 'url' => array('#'),
                                'submenuOptions' => array('class' => 'dropdown-menu'),
                                'linkOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'О чем говорят', 'url' => array('#')),
                                    array('label' => 'С чем едят', 'url' => array('#')),
                                    array('label' => 'Что пьют', 'url' => array('#')),
                                    array('label' => 'И далее по списку', 'url' => array('#'))
                                ))
                        ),
                    ));
                    ?>
                    <!--                    <ul>
                                            <li>
                                                <a href="#">Мнения</a>
                                            </li>
                                            <li class="active">
                                                <a href="#">О чем говорят?</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-toggle" href="#">Он-лайн проекты <i class="fa fa-angle-double-down"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">О чем говорят</a></li>
                                                    <li><a href="#">С чем едят</a></li>
                                                    <li><a href="#">Что пьют</a></li>
                                                    <li><a href="#">И далее по списку</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="dropdown-toggle" class="dropdown-toggle"  href="#">Старый Сургут &nbsp;<i class="fa fa-angle-double-down"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">О чем говорят</a></li>
                                                    <li><a href="#">С чем едят</a></li>
                                                    <li><a href="#">Что пьют</a></li>
                                                    <li><a href="#">И далее по списку</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Фоторепортажи</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-toggle" class="dropdown-toggle" href="#">Спецпроекты <i class="fa fa-angle-double-down"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">О чем говорят</a></li>
                                                    <li><a href="#">С чем едят</a></li>
                                                    <li><a href="#">Что пьют</a></li>
                                                    <li><a href="#">И далее по списку</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Недвижимость</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-toggle" class="dropdown-toggle"  href="#">Официально <i class="fa fa-angle-double-down"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">О чем говорят</a></li>
                                                    <li><a href="#">С чем едят</a></li>
                                                    <li><a href="#">Что пьют</a></li>
                                                    <li><a href="#">И далее по списку</a></li>
                                                </ul>
                                            </li>
                    
                                        </ul>-->
                </nav>
                <div id="content-line" class="clearfix">
                    <div id="hot">Горячие темы: <a href="#">Образ новой России</a> <a href="#">Что твориться в Крыму?</a> <a href="#">Новые политические веения Владимира ПУ</a> </div>
                    <div id="cources" class="a-right">
                        <span>EUR 50,4146 <i class="fa fa-sort-down red"></i></span>
                        &nbsp;
                        <span>USD 36,2070 <i class="fa fa-sort-down red"></i></span>
                    </div>
                </div>
            </header>


