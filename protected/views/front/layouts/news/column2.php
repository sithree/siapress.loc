<div class="row-fluid">
    <div class="span12">
        <div id="blogs">
            <?php $this->widget('Blogs'); ?>
            <div class="clr"></div>
        </div>

        <div class="row-fluid">
            <div style="text-align: center" id="morebutton">
                <?php
                echo Chtml::form();
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
                            $('#blogs').append(html);
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
                        ), array('class' => 'newsajaxbutton', 'rel' => 'politics', 'style' => 'color:gray; padding:10px; display: block; background-color: #eee; font-weight: bold; text-transform: uppercase;'));

                echo Chtml::form();
                ?>
            </div>
        </div>
    </div>
</div>