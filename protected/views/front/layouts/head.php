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
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,cyrillic" />

        <?php Yii::app()->clientScript->registerCssFile("/css/bootstrap.css"); ?>
        <?php Yii::app()->clientScript->registerCssFile("/css/font-awesome.min.css"); ?>
        <?php Yii::app()->clientScript->registerCssFile("/css/template.css"); ?>



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


        <?php Yii::app()->clientScript->registerScript('ga', "var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-21444679-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();"); ?>

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
    <?php Yii::app()->clientScript->registerScriptFile('/scripts/scripts.js'); ?>
    <body>

        <div class="container">
            <div id="ageWarning">16+</div>
            <div style="line-height: 100%; font-size:11px; color:#aaa; position: absolute; top:59px; z-index:100;">Сайт на реконструкции, <br />возможны неполадки</div>
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
                        <?php
                        if ($this->beginCache("TopBlogs", array('dependency' => array(
                                        'class' => 'system.caching.dependencies.CExpressionDependency',
                                        'expression' => "Article::getCacheDependency('TopBlogs')")))) {
                            ?>
                            <?php $this->widget('application.components.widgets.bloggers'); ?>                    
                            <?php
                            $this->endCache();
                        }
                        ?>
                    </div>
                </div>

                <div id="mainNav">
                    <nav>
                        <?php
                        Yii::beginProfile('menu');

                        $this->widget('zii.widgets.CMenu', array(
                            'encodeLabel' => false,
                            'items' => array(
                                array('label' => 'Мнения', 'url' => array('article/index', 'category' => 'opinion')),
                                array('label' => 'О чем говорят', 'url' => array('article/index', 'category' => 'say')),
                                array('label' => 'Онлайн-проекты', 'url' => array('article/index', 'category' => 'online'),
                                    'submenuOptions' => array('class' => 'dropdown-menu'),
                                    'linkOptions' => array('class' => 'dropdown-toggle'),
                                    'activateParents' => true,
                                    'activateItems' => false,
                                    'items' => array(
                                        array('label' => 'О чем говорят', 'url' => array('article/index', 'category' => 'say')),
                                        array('label' => 'Онлайн-конференции', 'url' => array('article/index', 'category' => 'query')),
                                        array('label' => 'Сургутские старости', 'url' => array('article/index', 'category' => 'starosti')),
                                        array('label' => 'Особое мнение', 'url' => array('article/index', 'category' => 'specopinion')),
                                    )),
                                array('label' => 'Старый Сургут', 'url' => array('article/index', 'category' => 'oldsurgut'),
                                    'submenuOptions' => array('class' => 'dropdown-menu'),
                                    'linkOptions' => array('class' => 'dropdown-toggle'),
                                    'activateParents' => true,
                                    'activateItems' => false,
                                    'items' => array(
                                        array('label' => 'Улицы Сургута', 'url' => array('article/index', 'category' => 'streets')),
                                        array('label' => 'Дневники Ивана Захарова', 'url' => array('article/index', 'category' => 'zaharov')),
                                        array('label' => 'Тайны истории', 'url' => array('article/index', 'category' => 'history')),
                                        array('label' => 'Сургутские старости', 'url' => array('article/index', 'category' => 'starosti')),
                                        array('label' => 'Очерки', 'url' => array('article/index', 'category' => 'ocherki')),
                                        array('label' => 'Цифирь', 'url' => array('article/index', 'category' => 'cifir')),
                                    )),
                                array('label' => 'Фото', 'url' => array('article/index', 'category' => 'photo'),
                                    'submenuOptions' => array('class' => 'dropdown-menu'),
                                    'linkOptions' => array('class' => 'dropdown-toggle'),
                                    'activateParents' => true,
                                    'activateItems' => false,
                                    'items' => array(
                                        array('label' => 'Фоторепортажи', 'url' => array('article/index', 'category' => 'photorep')),
                                        array('label' => 'Фотонеделя', 'url' => array('article/index', 'category' => 'photoweek')),
                                        array('label' => 'Фотофакт от читателей', 'url' => array('article/index', 'category' => 'photofact')),
                                        array('label' => 'Непорядок', 'url' => array('article/index', 'category' => 'disorder')),
                                    )),
                                array('label' => 'Спецпроекты', 'url' => array('article/index', 'category' => 'special'),
                                    'submenuOptions' => array('class' => 'dropdown-menu'),
                                    'linkOptions' => array('class' => 'dropdown-toggle'),
                                    'activateParents' => true,
                                    'activateItems' => false,
                                    'items' => array(
                                        array('label' => 'Здоровье', 'url' => array('article/index', 'category' => 'health')),
                                        array('label' => 'Потребитель', 'url' => array('article/index', 'category' => 'potrebitel')),
                                        array('label' => 'Огород', 'url' => array('article/index', 'category' => 'ogorod')),
                                        array('label' => 'Авто', 'url' => array('article/index', 'category' => 'auto')),
                                        array('label' => 'Недвижимость', 'url' => array('article/index', 'category' => 'relt')),
                                    )),
                                array('label' => 'Компании', 'url' => array('article/index', 'category' => 'companies')),
                                array('label' => 'Недвижимость', 'url' => array('article/index', 'category' => 'realty')),
                            ),
                        ));
                        Yii::endProfile('menu');
                        ?>

                    </nav>
                    <ul id="socialLinks">
                        <li><a href="/rss" title="RSS лента"><i class="fa fa-rss"></i> </a></li>
                    </ul>
                </div>
                <div id="content-line" class="clearfix">
                    <?php $this->widget('application.components.widgets.themes'); ?>

                    <div id="cources" class="a-right">
                        <span>EUR 	48,6435</span>
                        &nbsp;
                        <span>USD 35,5010	</span>
                    </div>
                </div>
            </header>


