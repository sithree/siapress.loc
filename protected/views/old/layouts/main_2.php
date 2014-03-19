<?php include 'head.php' ?>

<div class="container"><!-- Тело сайта -->
    <div class="row">
        <div class="span9"><!-- 1 и вторая колонка -->
            <div class="row">
                <div class="span7"><!-- Основной левый блок -->
                    <?php echo $content; ?>
                </div><!-- // Основной левый блок -->

                <div class="span2" id="blogs"><!-- Вторая колонка -->
                    <?php
                    $this->widget('Blogs');
                    ?>
                </div><!-- // Вторая колонка -->
            </div>
        </div>
        <div class="span3"><!-- Третья колонка -->
            <a target="_blank" href="/component/banners/click/53"><img alt="" src="http://www.siapress.ru/images/br/npf.gif"></a>
            <hr />

            <object width="280" height="260" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="FlashID"><param value="http://www.siapress.ru/images/br/ipoteka_280x260.swf" name="movie"><param value="high" name="quality"><param value="opaque" name="wmode"><param value="8.0.35.0" name="swfversion"><param value="Scripts/expressInstall.swf" name="expressinstall">
                <!--[if !IE]>-->
                <object width="280" height="260" data="http://www.siapress.ru/images/br/ipoteka_280x260.swf" type="application/x-shockwave-flash">
                    <!--<![endif]--><param value="high" name="quality"><param value="opaque" name="wmode"><param value="8.0.35.0" name="swfversion"><param value="Scripts/expressInstall.swf" name="expressinstall"><div><h4>Для содержимого этой страницы требуется более новая версия Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img width="112" height="33" alt="Получить проигрыватель Adobe Flash Player" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif"></a></p></div>
                    <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
            <hr />

            <object width="280" height="260" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="FlashID"><param value="http://www.siapress.ru/images/br/280х260.swf" name="movie"><param value="high" name="quality"><param value="opaque" name="wmode"><param value="8.0.35.0" name="swfversion"><param value="Scripts/expressInstall.swf" name="expressinstall">
                <!--[if !IE]>-->
                <object width="280" height="260" data="http://www.siapress.ru/images/br/280х260.swf" type="application/x-shockwave-flash">
                    <!--<![endif]--><param value="high" name="quality"><param value="opaque" name="wmode"><param value="8.0.35.0" name="swfversion"><param value="Scripts/expressInstall.swf" name="expressinstall"><div><h4>Для содержимого этой страницы требуется более новая версия Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img width="112" height="33" alt="Получить проигрыватель Adobe Flash Player" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif"></a></p></div>
                    <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>

            <hr />

            <h6 class="margin red-b">Последние комментарии</h6>
            <ul class="unstyled">
                <li>
                    <span class="time2">08:20</span> от <a href="#">Mamin_Sibiriak</a><br />
                    <p class="comment">
                        Диме Попову нужно сначала проконсультиров аться с Ханты-Мансийском, только потом он ответит. Или , в...
                        <a href="#">Читать полностью...</a>
                    </p>
                    <span class="time2">08:20</span> от <a href="#">Mamin_Sibiriak</a><br />
                    <p class="comment">
                        Диме Попову нужно сначала проконсультиров аться с Ханты-Мансийском, только потом он ответит. Или , в...
                        <a href="#">Читать полностью...</a>
                    </p>
                    <span class="time2">08:20</span> от <a href="#">Mamin_Sibiriak</a><br />
                    <p class="comment">
                        Диме Попову нужно сначала проконсультиров аться с Ханты-Мансийском, только потом он ответит. Или , в...
                        <a href="#">Читать полностью...</a>
                    </p>
                    <span class="time2">08:20</span> от <a href="#">Mamin_Sibiriak</a><br />
                    <p class="comment">
                        Диме Попову нужно сначала проконсультиров аться с Ханты-Мансийском, только потом он ответит. Или , в...
                        <a href="#">Читать полностью...</a>
                    </p>
                    <span class="time2">08:20</span> от <a href="#">Mamin_Sibiriak</a><br />
                    <p class="comment">
                        Диме Попову нужно сначала проконсультиров аться с Ханты-Мансийском, только потом он ответит. Или , в...
                        <a href="#">Читать полностью...</a>
                    </p>
                </li>
            </ul>
            <hr />
            <div class="commercial">
                <h6>Реклама</h6>
            </div>

            <h6 class="margin red-b">Дежурный по сайту</h6>
            <p>Связаться по телефону: <strong>(3462) 44-23-23</strong><br>
                через Twitter: <strong>@siapress</strong><br>
                по e-mail: <a href="mailto:mnenie@novygorod.ru"><strong>mnenie@novygorod.ru</strong></a></p>
        </div><!-- // Третья колонка -->
    </div>
</div><!-- // Тело сайта -->
<div class="container"><hr /></div>

<?php include 'footer.php'; ?>