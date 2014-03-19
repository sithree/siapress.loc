<?php $this->setPageTitle(Yii::app()->name); ?>
<?php
Yii::app()->getClientScript()->registerScript('ajaxnewsbutton', "
    $('.newsajaxbutton').click(function(){
        $('#category').attr('value',$(this).attr('rel'));
        $('.newsajaxbutton').parent().removeClass('active');
        $(this).parent().addClass('active');
    });
");
?>
<div class="row-fluid">
    <div class="span12">
        <?php echo CHtml::form(); ?>
        <ul class="nav nav-pills">
            <li class="brand"><h6 class="hot-news">Главные новости &nbsp;&gt;</h6></li>

            <li class="active">
                <?php
                echo CHtml::hiddenField('category', 'politics');
                echo Chtml::ajaxLink('Политика', array('ajax/getmainnews'), array(
                    'type' => 'POST',
                    'update' => '#mainnews',
                    'beforeSend' => 'function(){
                        $("#mainnews").addClass("loading");
                    }',
                    'complete' => 'function(){
                        $("#mainnews").removeClass("loading");

                    }',
                        ), array('class' => 'newsajaxbutton', 'rel' => 'politics'));
                ?>

            </li>
            <li>
                <?php
                echo Chtml::ajaxLink('Происшествия', array('ajax/getmainnews'), array(
                    'type' => 'POST',
                    'update' => '#mainnews',
                    'beforeSend' => 'function(){
                        $("#mainnews").addClass("loading");
                    }',
                    'complete' => 'function(){
                        $("#mainnews").removeClass("loading");
                    }',
                        ), array('class' => 'newsajaxbutton', 'rel' => 'incident'));
                ?>
            </li>
            <li>
                <?php
                echo Chtml::ajaxLink('Экономика', array('ajax/getmainnews'), array(
                    'type' => 'POST',
                    'update' => '#mainnews',
                    'beforeSend' => 'function(){
                        $("#mainnews").addClass("loading");
                    }',
                    'complete' => 'function(){
                        $("#mainnews").removeClass("loading");
                    }',
                        ), array('class' => 'newsajaxbutton', 'rel' => 'economics'));
                ?>
            </li>
            <li>
                <?php
                echo Chtml::ajaxLink('Мегаполис', array('ajax/getmainnews'), array(
                    'type' => 'POST',
                    'update' => '#mainnews',
                    'beforeSend' => 'function(){
                        $("#mainnews").addClass("loading");
                    }',
                    'complete' => 'function(){
                        $("#mainnews").removeClass("loading");
                    }',
                        ), array('class' => 'newsajaxbutton', 'rel' => 'megapolis'));
                ?>
            </li>
            <li><?php
                echo Chtml::ajaxLink('Спорт', array('ajax/getmainnews'), array(
                    'type' => 'POST',
                    'update' => '#mainnews',
                    'beforeSend' => 'function(){
                        $("#mainnews").addClass("loading");
                    }',
                    'complete' => 'function(){
                        $("#mainnews").removeClass("loading");
                    }',
                        ), array('class' => 'newsajaxbutton', 'rel' => 'sport'));
                ?></li>
            <li>
                <?php
                echo Chtml::ajaxLink('Культура', array('ajax/getmainnews'), array(
                    'type' => 'POST',
                    'update' => '#mainnews',
                    'beforeSend' => 'function(){
                        $("#mainnews").addClass("loading");
                    }',
                    'complete' => 'function(){
                        $("#mainnews").removeClass("loading");
                    }',
                        ), array('class' => 'newsajaxbutton', 'rel' => 'life'));
                ?>
            </li>
        </ul>
        <?php echo CHtml::form(); ?>
    </div>
</div>
<div class="row-fluid" id="mainnews"><!-- Блок новостей -->
    <?php $this->widget('MainNews'); ?>
</div><!-- // Блок новостей -->

<hr />
<!-- Баннер. Позиция 2 -->

<!-- // Баннер. Позиция 2 -->
<style>
    .well.blogs:hover {
        background-color: rgba(200, 0, 0, 0.06)
    }
</style>

<div class="row-fluid">
    <div class="span6">
        <h6 class="red-b"><a href="/opinion" class="white" style="display: block; width: 100%; height: 100%;">Мнение</a></h6>
        <a class="well blogs" style="padding: 8px; display: block" href="#">
            <img style="width: 100px; margin-right:10px;" align="left" src="images/news/2012/06/22/19083.jpg">
            <h4 style="font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;">Невольная борьба</h4>
            <div style="color:#333;line-height: 120%;">На что рассчитывать России в Лондоне, если в регионах не поддерживают спорт?</div>
            <div style=" font-size: 11px;">
                <span style="color:gray;">27 июня  в 06:41</span>
                <span class="i-view">413</span>
                <span class="i-comment">2</span>
            </div>
            <div class="clr"></div>
        </a>
    </div>
    <div class="span6">
        <h6 class="red-b"><a href="/opinion" class="white" style="display: block; width: 100%; height: 100%;">Мнение</a></h6>
        <a class="well blogs" style="padding: 8px; display: block" href="#">
            <img style="width: 100px; margin-right:10px;" align="left" src="images/news/2012/06/22/19083.jpg">
            <h4 style="font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;">Невольная борьба</h4>
            <div style="color:#333;line-height: 120%;">На что рассчитывать России в Лондоне, если в регионах не поддерживают спорт?</div>
            <div style=" font-size: 11px;">
                <span style="color:gray;">27 июня  в 06:41</span>
                <span class="i-view">413</span>
                <span class="i-comment">2</span>
            </div>
            <div class="clr"></div>
        </a>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <h6 class="red-b"><a href="/opinion" class="white" style="display: block; width: 100%; height: 100%;">Мнение</a></h6>
        <a class="well blogs" style="padding: 8px; display: block" href="#">
            <img style="width: 100px; margin-right:10px;" align="left" src="images/news/2012/06/22/19083.jpg">
            <h4 style="font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;">Невольная борьба</h4>
            <div style="color:#333;line-height: 120%;">На что рассчитывать России в Лондоне, если в регионах не поддерживают спорт?</div>
            <div style=" font-size: 11px;">
                <span style="color:gray;">27 июня  в 06:41</span>
                <span class="i-view">413</span>
                <span class="i-comment">2</span>
            </div>
            <div class="clr"></div>
        </a>
    </div>
    <div class="span6">
        <h6 class="red-b"><a href="/opinion" class="white" style="display: block; width: 100%; height: 100%;">Мнение</a></h6>
        <a class="well blogs" style="padding: 8px; display: block" href="#">
            <img style="width: 100px; margin-right:10px;" align="left" src="images/news/2012/06/22/19083.jpg">
            <h4 style="font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;">Невольная борьба</h4>
            <div style="color:#333;line-height: 120%;">На что рассчитывать России в Лондоне, если в регионах не поддерживают спорт?</div>
            <div style=" font-size: 11px;">
                <span style="color:gray;">27 июня  в 06:41</span>
                <span class="i-view">413</span>
                <span class="i-comment">2</span>
            </div>
            <div class="clr"></div>
        </a>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <h6 class="red-b"><a href="/opinion" class="white" style="display: block; width: 100%; height: 100%;">Мнение</a></h6>
        <a class="well blogs" style="padding: 8px; display: block" href="#">
            <img style="width: 100px; margin-right:10px;" align="left" src="images/news/2012/06/22/19083.jpg">
            <h4 style="font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;">Невольная борьба</h4>
            <div style="color:#333;line-height: 120%;">На что рассчитывать России в Лондоне, если в регионах не поддерживают спорт?</div>
            <div style=" font-size: 11px;">
                <span style="color:gray;">27 июня  в 06:41</span>
                <span class="i-view">413</span>
                <span class="i-comment">2</span>
            </div>
            <div class="clr"></div>
        </a>
    </div>
    <div class="span6">
        <h6 class="red-b"><a href="/opinion" class="white" style="display: block; width: 100%; height: 100%;">Мнение</a></h6>
        <a class="well blogs" style="padding: 8px; display: block" href="#">
            <img style="width: 100px; margin-right:10px;" align="left" src="images/news/2012/06/22/19083.jpg">
            <h4 style="font-size: 14px;
                font-weight: bold;
                margin-bottom: 2px;">Невольная борьба</h4>
            <div style="color:#333;line-height: 120%;">На что рассчитывать России в Лондоне, если в регионах не поддерживают спорт?</div>
            <div style=" font-size: 11px;">
                <span style="color:gray;">27 июня  в 06:41</span>
                <span class="i-view">413</span>
                <span class="i-comment">2</span>
            </div>
            <div class="clr"></div>
        </a>
    </div>
</div>
<hr />
<!-- Фоторепы -->
<div class="row-fluid">
    <h6 style="margin-bottom: 5px">Экслюзив</h6>
</div>
<?php $this->widget('application.components.main.photos'); ?>

<div class="row-fluid" style="text-align: right">
    <br />
    Смотреть <a class="btn1" href="<?php echo Yii::app()->createUrl('photos/index'); ?>">все фоторепортажи →</a>
</div>
<hr />
<!-- // Фоторепы -->
<?php
Yii::app()->getClientScript()->registerScript('exclusive', "
  $('.exclusive').hover(function(){
            var h = $('.ex_desc', this).height();
            var h2 = 123;
            $('.ex_cont', this).animate({
                marginTop: h2 - h
            }, 200);
        }, function(){
            var h = $('.ex_desc', this).height();
            var h2 = 123;
            $('.ex_cont', this).animate({
                marginTop: h2
            }, 200);
        });
 ");
?>

<!-- Пресс релизы -->
<?php $this->widget('application.components.main.official'); ?>
<!-- // Пресс релизы -->
<hr />

<!-- голосовалки -->
<div class="row-fluid">
    <div class="span6">
        <h6 class="margin red-b">Как вы голосовали на выборах 4 марта?</h6>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Из протестных соображений – за любого, лишь бы против Путина
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            По своим убеждениям
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            По принуждению
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Шалил, не воспринимая выборы всерьез
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Выборы проигнорировал
        </label>
        <div>
            <p class="gray small right info">Комментарии: <span>20</span> &nbsp;&nbsp;&nbsp;&nbsp; Всего голосов: <span class="label">602</span></p>
        </div>
        <hr>
        <p class="right">
            <input class="btn btn-danger" value="Голосовать" type="submit">
        </p>
    </div>
    <div class="span6">
        <h6 class="margin red-b">Как вы голосовали на выборах 4 марта?</h6>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Из протестных соображений – за любого, лишь бы против Путина
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            По своим убеждениям
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            По принуждению
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Шалил, не воспринимая выборы всерьез
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Выборы проигнорировал
        </label>
        <div>
            <p class="gray small right info">Комментарии: <span>20</span> &nbsp;&nbsp;&nbsp;&nbsp; Всего голосов: <span class="label">602</span></p>
        </div>
        <hr>
        <p class="right">
            <input class="btn btn-danger" value="Голосовать" type="submit">
        </p>
    </div>
</div>
<hr />
<div class="row-fluid">
    <div class="span6 poll">

        <h6 class="margin red-b">Как вы голосовали на выборах 4 марта?</h6>
        <p>Из протестных соображений – за любого, лишь бы против Путина  - 20%</p>
        <div class="progress">
            <div class="bar" style="width: 20%;"></div>
        </div>
        <p>По своим убеждениям</p>
        <div class="progress">
            <div class="bar" style="width: 75%;"></div>
        </div>

        <p>По принуждению</p>
        <div class="progress">
            <div class="bar" style="width: 40%;"></div>
        </div>

        <p>Шалил, не воспринимая выборы всерьез</p>
        <div class="progress">
            <div class="bar" style="width: 20%;"></div>
        </div>

        <p>Выборы проигнорировал - 23%</p>
        <div class="progress">
            <div class="bar" style="width: 23%;"></div>
        </div>

        <div>
            <p class="gray small right info">Комментарии: <span>20</span> &nbsp;&nbsp;&nbsp;&nbsp; Всего голосов: <span class="label">602</span></p>
        </div>
    </div>

    <div class="span6">

        <h6 class="margin red-b">Как вы голосовали на выборах 4 марта?</h6>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Из протестных соображений – за любого, лишь бы против Путина
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            По своим убеждениям
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            По принуждению
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Шалил, не воспринимая выборы всерьез
        </label>
        <label class="radio">
            <input checked="checked" value="option1" id="optionsRadios1" name="optionsRadios" type="radio">
            Выборы проигнорировал
        </label>
        <div>
            <p class="gray small right info">Комментарии: <span>20</span> &nbsp;&nbsp;&nbsp;&nbsp; Всего голосов: <span class="label">602</span></p>
        </div>
        <hr>
        <p class="right">
            <input class="btn btn-danger" value="Голосовать" type="submit">
        </p>


    </div>
</div>
<div class="row-fluid" style="text-align: right">
    <br />
    Смотреть <a class="btn1" href="#">все голосования→</a>
</div>