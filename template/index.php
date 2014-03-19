<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title><?php // echo CHtml::encode($this->pageTitle);                       ?></title>

        <base href="/template/" />
        <?php // echo $this->getMetaProperty(); ?>
        <meta name="google-site-verification" content="o6O0JpTfyv-GyBqTFgVREC4zxXwukjIN3mEMLKJY3i4" />
        <meta name="229962aa5cb18d18191965311d4422ec" content="">
        <meta name="wot-verification" content="1dff145b2373cca16a3f"/>

        <?php // Yii::app()->clientScript()-registerCssFile('/css/bootstrap.css'); ?>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/template.css" />



        <!-- Le styles -->

        <!--<link rel="shortcut icon" href="<?php // echo Yii::app()->request->baseUrl;                       ?>/images/favicon.ico">-->

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/ico/144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/ico/114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/ico/72.png">
        <link rel="apple-touch-icon-precomposed" href="/img/ico/57.png">
        <link rel="alternate" type="application/rss+xml" title="СИА-ПРЕСС. RSS Feed" href="http://www.siapress.ru/rss" />

        <?php
        //Добавляем код кнопки наверх
//        Yii::app()->getClientScript()->registerScript('toptop', "
//                $('a#back-top').click(function () {
//                    $('body,html').animate({
//                        scrollTop: 0
//                    }, 500); // скорость прокрутки
//                    return false;
//                });
//
//                $(window).scroll(function () {
//                    if ($(this).scrollTop() > 100) // количество прокрученных пикселей, после которых начинает отображаться кнопка вверх на сайте.
//                                {
//                        $('#back-top').fadeIn();
//                    } else {
//                        $('#back-top').fadeOut();
//                    }
//                });
//        ");
        ?>
        <script type="text/javascript" src="http://www.siapress.ru/assets/426282c0/jquery.min.js"></script>
        <script>
            $(function() {
                $(".dropdown-toggle").click(function() {
                    return false;
                });
            });
        </script>
    </head>

    <body>
        <div class="container">
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
                    <ul>
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

                    </ul>
                </nav>
                <div id="content-line" class="clearfix">
                    <div id="hot">Горячие темы: <a href="#">Образ новой России</a> <a href="#">Что твориться в Крыму?</a> <a href="#">Что т ораз</a> <a href="#">Что т ораз</a> <a href="#">Что т ораз</a></div>
                    <div id="cources">
                        <span>EUR 41.12313 <i class="fa fa-sort-down"></i></span>
                    </div>
                </div>
            </header>

            <div class="row">
                <div class="col-xs-3"   id="left">
                    <div class="widget b-light-gray main-news">
                        <div class="header">
                            <h2><a href="#">Новости</a></h2>
                        </div>
                        <ul>
                            <li>
                                <header class="clearfix">
                                    <a href="#"><img src="http://www.siapress.ru/images/news/main/30495_cat.jpg" alt="" /></a>
                                    <h3>
                                        <a href="#">Павел Дуров назвал семь причин не уезжать из России </a>
                                    </h3>
                                </header>
                                <footer class="row clearfix">
                                    <div class="col-xs-7"><a href="#">Политика</a>, сегодня в 12:99</div>
                                    <div class="col-xs-5"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                </footer>
                            </li>
                            <li>
                                <header class="clearfix">        
                                    <h3>
                                        <a href="#">Виктор Янукович: «Я жив и остаюсь легитимным президентом Украины» </a>
                                    </h3>
                                </header>
                                <footer class="row clearfix">
                                    <div class="col-xs-7"><a href="#">Политика</a>, сегодня в 12:99</div>
                                    <div class="col-xs-5"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                </footer>
                            </li>
                            <li>
                                <header class="clearfix">

                                    <h3>
                                        <a href="#">Молодые сургутяне вернулись с первенства Югры по боксу с наилучшими результатами  </a>
                                    </h3>
                                </header>
                                <footer class="row clearfix">
                                    <div class="col-xs-7"><a href="#">Политика</a>, сегодня в 12:99</div>
                                    <div class="col-xs-5"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                </footer>
                            </li>
                            <li>
                                <header class="clearfix">
                                    <a href="#"><img src="http://www.siapress.ru/images/news/main/30495_cat.jpg" alt="" /></a>
                                    <h3>
                                        <a href="#">Пресс-конференция Виктора Януковича. ОНЛАЙН</a>
                                    </h3>
                                </header>
                                <footer class="row clearfix">
                                    <div class="col-xs-7"><a href="#">Политика</a>, сегодня в 12:99</div>
                                    <div class="col-xs-5"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                </footer>
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">Больше новостей</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6"   id="center"> 
                    <div class="widget first-news  no-padding">
                        <div class="header">
                            <h2><a href="#">Главные новости</a></h2>
                        </div>

                        <header class="clearfix">

                            <h1>
                                <a href="#">Павел Дуров назвал семь причин не уезжать из России </a>
                            </h1>
                        </header>

                        <a href="#"><img src="http://www.siapress.ru/images/news/main/30495_cat.jpg" alt="" /></a>
                        <p>Одним пользователям его позитивный посыл пришелся по душе, другие же спародировали его
                            Одним пользователям его позитивный посыл пришелся по душе, другие же спародировали его
                            Одним пользователям его позитивный посыл пришелся по душе, другие же спародировали его
                        </p>
                        <div class="clearfix"></div>
                        <footer class="clearfix ">
                            <div class="row">
                                <div class="col-xs-8"><a href="#">Политика</a>, сегодня в 12:99</div>
                                <div class="col-xs-4 a-right"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                            </div>
                        </footer>

                    </div>
                    <div class="widget no-padding" id="opinion">
                        <div class="header">
                            <h2><a href="#">Мнения</a></h2>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="opinion-block"> 
                                    <header class="clearfix">
                                        <a href="#">
                                            <img src="http://www.siapress.ru/images/news/main/30497_home.jpg" width="50" height="50" />
                                            <h3>Моя мама не просто учитель, моя мама – Ангел-хранитель…</h3>
                                        </a>
                                    </header>
                                    <footer>
                                        <div class="row">
                                            <div class="col-xs-7">Тарас Самборский, <span class="nowrap">сегодня в 12:99</span></div>
                                            <div class="col-xs-5 a-right"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="opinion-block"> 
                                    <header class="clearfix">
                                        <a href="#">
                                            <img src="http://www.siapress.ru/images/news/main/30497_home.jpg" width="50" height="50" />
                                            <h3>Моя мама не просто учитель, моя мама – Ангел-хранитель…</h3>
                                        </a>
                                    </header>
                                    <footer>
                                        <div class="row">
                                            <div class="col-xs-7">Тарас Самборский, <span class="nowrap">сегодня в 12:99</span></div>
                                            <div class="col-xs-5 a-right"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                        </div>
                                    </footer>
                                </div>
                                <div class="opinion-block"> 
                                    <header class="clearfix">
                                        <a href="#">
                                            <img src="http://www.siapress.ru/images/news/main/30497_home.jpg" width="50" height="50" />
                                            <h3>Моя мама не просто учитель, моя мама – Ангел-хранитель…</h3>
                                        </a>
                                    </header>
                                    <footer>
                                        <div class="row">
                                            <div class="col-xs-7">Тарас Самборский, <span class="nowrap">сегодня в 12:99</span></div>
                                            <div class="col-xs-5 a-right"><i class="fa fa-eye"></i> 124 <i class="fa fa-comment"></i> 123</div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-xs-3" id="right">
                    <div class="input-group" id="search">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div><!-- /input-group -->

                    

                </div>
            </div>

        </div>

        <p>123</p>

    </body>
</html>