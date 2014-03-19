<?php $this->widget('application.components.main.mbanner', array('position' => 12)); ?>
<hr />
<div class="footer"><!-- Подвал -->
    <div class="container">
        <div class="row">
            <div class="span4">
                <div class="vcard" id="">
                    <div class="org">Интернет-портал &copy; <strong>«СИА-ПРЕСС»</strong> 2012.</div>
                    <div class="adr"><span class="postal-code">628403</span>, <span class="country-name">Россия</span>, <span class="region">ХМАО-Югра</span>, город <span class="locality">Сургут</span>, <span class="street-address">Бульвар Свободы 1</span></div>
                    Телефон: <span class="tel">+7 (3462) 44-23-23 </span></div>
            </div>
            <div class="span5">
                <p>При использовании материалов ссылка обязательна. Свидетельство о регистрации СМИ: Эл № ФС77-33705 от 17 октября 2008 г. Редакция не несет ответственности за достоверность информации, опубликованной в рекламных объявлениях.<br />
                    <a href="/rules">Правила сайта</a>&nbsp;&nbsp;&nbsp;
                    <a href="media/files/new-sayt_siapress_3_lista.pdf">Рекламодателям (pdf)</a>&nbsp;&nbsp;&nbsp;
                    <!-- <a href="/license">Информация об ограничениях.</a>&nbsp;&nbsp;&nbsp;
                     <a href="/contacts/">Обратная связь</a>&nbsp;&nbsp;&nbsp;
                     <a href="#">Размещение рекламы</a>&nbsp;&nbsp;&nbsp;
                     <a href="#">Карта сайта</a>&nbsp;&nbsp;&nbsp; -->
                </p>
            </div>
            <div class="span3">
                <p class="right">Дизайн и разработка - <noindex><a rel="nofollow" target="_blank" href="http://minstudio.ru">minstudio.ru</a></noindex></p>
                <div style="text-align: right">
                    <!-- Начало кода счетчика UralWeb -->
                    <script type="text/javascript" language="JavaScript">// <![CDATA[
                        uralweb_d=document;
                        uralweb_a='';
                        uralweb_a+='&r='+escape(uralweb_d.referrer);
                        uralweb_js=10;
                        // ]]></script>
                    <script type="text/javascript" language="JavaScript1.1">// <![CDATA[
                        uralweb_a+='&j='+navigator.javaEnabled();
                        uralweb_js=11;
                        // ]]></script>
                    <script type="text/javascript" language="JavaScript1.2">// <![CDATA[
                        uralweb_s=screen;
                        uralweb_a+='&s='+uralweb_s.width+'*'+uralweb_s.height;
                        uralweb_a+='&d='+(uralweb_s.colorDepth?uralweb_s.colorDepth:uralweb_s.pixelDepth);
                        uralweb_js=12;
                        // ]]></script>
                    <script type="text/javascript" language="JavaScript1.3">// <![CDATA[
                        uralweb_js=13;
                        // ]]></script>
                    <script type="text/javascript" language="JavaScript">// <![CDATA[
                        uralweb_d.write('<a href="http://www.uralweb.ru/rating/go/siapress">'+
                            '<img border="0" src="http://hc.uralweb.ru/hc/siapress?js='+
                            uralweb_js+'&rand='+Math.random()+uralweb_a+
                            '" width="88" height="31" alt="Рейтинг UralWeb" /><'+'/a>');
                        // ]]></script>

                    <noscript><noindex><a  rel="nofollow" href="http://www.uralweb.ru/rating/go/siapress"> <img src="http://hc.uralweb.ru/hc/siapress?js=0" alt="Рейтинг UralWeb" width="88" height="31" border="0" /></a></noindex></noscript><!-- конец кода счетчика UralWeb --> <!--LiveInternet counter-->

                    <script type="text/javascript">// <![CDATA[
                        document.write("<a href='http://www.liveinternet.ru/click' "+
                            "target=_blank><img src='//counter.yadro.ru/hit?t14.6;r"+
                            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                            ";h"+escape(document.title.substring(0,80))+";"+Math.random()+
                            "' alt='' title='LiveInternet: показано число просмотров за 24"+
                            " часа, посетителей за 24 часа и за сегодня' "+
                            "border='0' width='88' height='31'><\/a>")
                        // ]]></script>
                    <!--/LiveInternet-->

                    <!-- Yandex.Metrika counter -->
                    <script type="text/javascript">// <![CDATA[
                        (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter73742 = new Ya.Metrika({id:73742, enableAll: true, trackHash:true, webvisor:true,type:1}); } catch(e) {} }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");
                        // ]]></script>

                    <noscript>
                    <div><img alt="Счетчик Яндекс" style="position: absolute; left: -9999px;" src="//mc.yandex.ru/watch/73742?cnt-class=1" /></div>
                    </noscript><!-- /Yandex.Metrika counter -->


                </div>
            </div>
        </div>
    </div>
</div><!-- // Подвал -->
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Авторизация на сайте</h3>
</div>

<?php echo CHtml::form(array('ajax/login')); ?>
<div class="modal-body">
    <div class="row-fluid">
        <div class="span6">
            <h4>Войти как пользователь</h4>
            <br />
            <?php
            $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
            ?>
        </div>
        <div class="span6">
            <h4>Войти по логину СИА-ПРЕСС</h4>
            <br />
            <div id="loginresult"></div>

            <?php echo @CHtml::textField('login', $login, array('class' => 'span10', 'placeholder' => 'Логин')); ?>
            <?php echo @CHtml::textField('password', $passswrod, array('class' => 'span10', 'placeholder' => 'Пароль')); ?>
            <label class="checkbox">
                <input type="checkbox" id="save" />
                <label for="save">Запомнить введенные данные </label>
            </label>
            <a href="#">Забыли пароль?</a> | <a href="#">Регистрация</a>

        </div>
    </div>
</div>
<div class="modal-footer">

    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'type' => 'danger',
        'label' => 'Авторизоваться',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Закрыть',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>
<?php echo CHtml::endForm(); ?>
<?php $this->endWidget(); ?>
</div>
</body>
</html>
