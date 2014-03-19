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

<!--  2_1 -->
<div class="rontar"  id="rontar_adplace_3850"></div>
<script type="text/javascript"><!--

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 3850, rontar_place_id: 'rontar_adplace_3850', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
<!-- /// 2_1 -->


<div class="row-fluid">
    <div class="span9"><!-- Левая панель  -->
        <div class="row-fluid">
            <div class="span8"><!-- Левая внутренняя -->
                <!-- 2 -->
                <div id="rontar_adplace_3849"></div>
                <script type="text/javascript"><!--

                    (function(w, d, n) {
                        var ri = {rontar_site_id: 1717, rontar_adplace_id: 3849, rontar_place_id: 'rontar_adplace_3849', adCode_rootUrl: 'http://adcode.rontar.com/'};
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

                <!-- /// 2 -->
                <!-- 2 570-90 -->
                <div id="rontar_adplace_3866"></div>
                <script type="text/javascript"><!--

                    (function(w, d, n) {
                        var ri = {rontar_site_id: 1717, rontar_adplace_id: 3866, rontar_place_id: 'rontar_adplace_3866', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
                <!-- /// 2 570-90 -->

                <div style="margin-bottom: 15px;">
                    <?php $this->widget('MainNews'); ?>
                </div>
                <!-- Баннер. Позиция 6 -->
                <div id="rontar_adplace_4671"></div>
                <script type="text/javascript"><!--

                    (function(w, d, n) {
                        var ri = {rontar_site_id: 1717, rontar_adplace_id: 4671, rontar_place_id: 'rontar_adplace_4671', adCode_rootUrl: 'http://adcode.rontar.com/'};
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




                <div class="row-fluid">
                    <hr />
                </div>

                <?php $this->widget('application.components.main.official'); ?>
                
                <div class="row-fluid">
                    <div class="span12 poll">
                        <?php $this->widget('EPoll'); ?>
                    </div>
                </div>   
                <div class="row-fluid">
                    <div class="span12 poll">
                        <?php $this->widget('EPoll'); ?>
                    </div>
                </div> 
                
                <div class="row-fluid">
                    <div class="span12 poll">
                        <?php $this->widget('EPoll'); ?>
                    </div>
                </div> 
                 <div class="row-fluid">
                    <div class="span12 poll">
                        <?php $this->widget('EPoll'); ?>
                    </div>
                </div> 
                <div class="row-fluid">
                    <div class="span12 poll">
                        <?php $this->widget('EPoll'); ?>
                    </div>
                </div>
                
            </div><!-- end.Левая внутренняя -->

            <div class="span4"><!-- Центральная панель -->
                <div id="blogs">
                    <?php $this->widget('Blogs'); ?>
                    <div class="clr"></div>
                </div>
                <br />
                <div class="row-fluid">
                    <div style="text-align: center" id="morebutton">
                        <?php
                        echo Chtml::form('blogajaxform');
                        echo CHtml::hiddenField('page', '2', array('autocomplete' => 'off'));
                        echo Chtml::ajaxLink('Больше мнений', array('ajax/getopinions'), array(
                            'type' => 'POST',
                            #'update' => '#ph',
                            'beforeSend' => 'function(){
                          var page =  parseInt($("#page").attr("value"));
                          now = page + 1;
                          $("#page").attr("value", now);
                          $("#morebutton").addClass("loading");
                          }',
                            'complete' => 'function(){
                          $("#morebutton").removeClass("loading");

                          }',
                            'success' => "function(html){
                          $('#blogload').append(html);
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

                          }"
                                ), array('id' => 'blogajax', 'class' => 'newsajaxbutton', 'rel' => 'politics', 'style' => 'color:gray; padding:10px; display: block; background-color: #eee; font-weight: bold; text-transform: uppercase;'));

                        echo Chtml::endForm();
                        ?>
                    </div>
                </div>
            </div><!-- end.Центральная панель -->
        </div>


    </div><!-- end.Левая панель  -->
    <div class="span3"><!-- Правая панель -->

        <!-- C1_1 -->
        <div id="rontar_adplace_4155"></div>
        <script type="text/javascript"><!--

            (function(w, d, n) {
                var ri = {rontar_site_id: 1717, rontar_adplace_id: 4155, rontar_place_id: 'rontar_adplace_4155', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
        <!-- /// C1_1 -->
        <!-- C1 -->
        <div id="rontar_adplace_3843"></div>
        <div style="height: 15px" ></div>
        <script type="text/javascript"><!--

            (function(w, d, n) {
                var ri = {rontar_site_id: 1717, rontar_adplace_id: 3843, rontar_place_id: 'rontar_adplace_3843', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
        <!-- /// C1 -->


        <!-- C2 -->
        <div id="rontar_adplace_3842"></div>
        
        <script type="text/javascript"><!--

            (function(w, d, n) {
                var ri = {rontar_site_id: 1717, rontar_adplace_id: 3842, rontar_place_id: 'rontar_adplace_3842', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
        <!-- /// C2 -->

        <div id="rontar_adplace_3868"></div>
        <script type="text/javascript"><!--

            (function(w, d, n) {
                var ri = {rontar_site_id: 1717, rontar_adplace_id: 3868, rontar_place_id: 'rontar_adplace_3868', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
        <!-- c3 -->    
        <div style="height: 15px" ></div>
        <div id="rontar_adplace_4931"></div>
        <script type="text/javascript"><!--

            (function(w, d, n) {
                var ri = {rontar_site_id: 1717, rontar_adplace_id: 4931, rontar_place_id: 'rontar_adplace_4931', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
        <!-- /// c3 -->

        <!-- c4 -->
        <div style="height: 15px" ></div>
        <div id="rontar_adplace_5140"></div>
        <script type="text/javascript"><!--

            (function(w, d, n) {
                var ri = {rontar_site_id: 1717, rontar_adplace_id: 5140, rontar_place_id: 'rontar_adplace_5140', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
        <!-- /// c4 -->
        
        <!-- подписка -->
        <div style="height: 15px" ></div>
<div id="rontar_adplace_5144"></div>
<script type="text/javascript"><!--
 
    (function (w, d, n) {
        var ri = { rontar_site_id: 1717, rontar_adplace_id: 5144, rontar_place_id: 'rontar_adplace_5144', adCode_rootUrl: 'http://adcode.rontar.com/' };
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
        
        <!-- //подписка -->

        <?php $this->widget('application.components.main.quest'); ?>

        <?php include($_SERVER['DOCUMENT_ROOT'] . '/_lm8ea8f138e7abf12fd3b69de62a906877/linkmoney.php'); ?>

        <?php $this->widget('application.components.main.mbanner', array('position' => 102)); ?>

        <?php $this->widget('application.components.main.mbanner', array('position' => 101)); ?>
        <?php $this->widget('application.components.main.popular'); ?>
        <div class="well block-comment" style="padding: 8px;background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);">
            <!-- Gismeteo informer START -->
            <link rel="stylesheet" type="text/css" href="http://www.gismeteo.ru/static/css/informer2/gs_informerClient.min.css">
            <div style="widnth:100%; overflow: hidden">
                <div id="gsInformerID-82e4e4O6" class="gsInformer" style="width:100%;height:224px">
                    <div class="gsIContent">
                        <noindex>
                            <div id="cityLink">
                                <a rel="nofollow" href="http://www.gismeteo.ru/city/daily/3994/" target="_blank">Погода в Сургуте</a>
                            </div>
                            <div class="gsLinks">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="leftCol">
                                                <a rel="nofollow" href="http://www.gismeteo.ru" target="_blank">
                                                    <img alt="Gismeteo" title="Gismeteo" src="http://www.gismeteo.ru/static/images/informer2/logo-mini2.png" align="absmiddle" border="0" />
                                                    <span>Gismeteo</span>
                                                </a>
                                            </div>
                                            <div class="rightCol">
                                                <a rel="nofollow" href="http://www.gismeteo.ru/city/weekly/3994/" target="_blank">Прогноз на 2 недели</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </noindex>
                    </div>
                </div>
            </div>
            <script src="http://www.gismeteo.ru/ajax/getInformer/?hash=82e4e4O6" type="text/javascript"></script>
            <!-- Gismeteo informer END -->
        </div>
        <?php $this->widget('application.components.main.mbanner', array('position' => 32)); ?>
        <?php $this->widget('application.components.main.mbanner', array('position' => 3)); ?>
        <?php $this->widget('application.components.main.mbanner', array('position' => 31)); ?>

        <?php #$this->widget('application.components.main.lastcomments'); ?>
        <?php $this->widget('application.components.main.mbanner', array('position' => 6)); ?>

        <h6 class="block-header">Дежурный по сайту</h6>
        <div class="well block-comment" style="padding: 8px;background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);">
            <p>Юрий Нуреев, тел.: <b>(3462) 44-23-23, доб. 305</b><br />
                по e-mail: <b>nureev@novygorod.ru</b></p>
        </div>

        <h6 class="block-header">Реклама на сайте</h6>
        <div class="well block-comment" style="padding: 8px;background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);">
            <p>Ангелина Медведева, тел.: <b>(3462) 44-23-23, доб. 205</b><br />
                по e-mail: <b>ng@surgutreklama.ru</b></p>
        </div>



    </div><!-- end.Правая панель -->
</div>




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



