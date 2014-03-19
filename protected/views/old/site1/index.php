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
<?php $this->widget('application.components.main.mbanner', array('position' => 13)); ?>
<div class="row-fluid">
    <div class="span9"><!-- Левая панель  -->
        <?php $this->widget('application.components.main.mbanner', array('position' => 2)) ?>

        <div class="row-fluid">
            <div class="span8"><!-- Левая внутренняя -->
                <?php $this->widget('application.components.main.mbanner', array('position' => 4)); ?>
                <div style="margin-bottom: 15px;">
                    <?php $this->widget('MainNews'); ?>
                </div>
                <?php $this->widget('application.components.main.mbanner', array('position' => 5)); ?>
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

                        echo Chtml::form();
                        ?>
                    </div>
                </div>
            </div><!-- end.Центральная панель -->
        </div>


    </div><!-- end.Левая панель  -->
    <div class="span3"><!-- Правая панель -->
        <?php $this->widget('application.components.main.mbanner', array('position' => 100)); ?>
        <?php $this->widget('application.components.main.quest'); ?>
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
        <?php $this->widget('application.components.main.mbanner', array('position' => 3)); ?>
        <?php $this->widget('application.components.main.mbanner', array('position' => 31)); ?>

        <?php #$this->widget('application.components.main.lastcomments'); ?>
        <?php $this->widget('application.components.main.mbanner', array('position' => 6)); ?>

        <h6 class="block-header">Дежурный по сайту</h6>
        <div class="well block-comment" style="padding: 8px;background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);">
            <p>Связаться по телефону: <b>(3462) 44-23-23</b><br />
                по e-mail: <b>reklama@siapress.ru</b></p>
        </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/_lm8ea8f138e7abf12fd3b69de62a906877/linkmoney.php'); ?>

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



