<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$i = -1;
$p = 9;
?>

<div class="span12" style="margin-bottom: 0px; min-height: 0px">
    <h6 class="block-header">Последние новости</h6>
</div>
<div class="row-fluid" style="margin-bottom: 10px;">
    <div class="span12 well" style="margin-bottom: 0; padding: 8px;background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);">

        <div class="span5"><!-- Главная новость на главной -->
            <?php
            #$main = Article::model()->getMainitem('politics');
            ?>
            <a href="<?php echo Article::model()->getArticlestriplink($main); ?>" class="thumbnail margin">
                <img style="width: 260px;" src="<?php echo Article::model()->getImgpath($main['id'], $main['created'], true, false, '_main');
            ?>" alt="<?php echo $main['title'] ?>">
            </a>

        </div>
        <div class="span7">
            <h1 class="margin main-h1">
                <a href="<?php echo Article::model()->getArticlestriplink($main); ?>"><?php echo $main['title'] ?></a>
            </h1>
            <p><?php echo $main['introtext'] ?></p>
            <a href="#"><span class="created"><?php echo Helper::getFormattedtime($main['publish'], false, true) ?></span></a>&nbsp;&nbsp;
            <span class="i-view"><?php echo $main['hits'] ?></span>
            <a href="<?php echo Article::model()->getArticlestriplink($main); ?>#comments"><span class="i-comment"><?php echo $main['comment_count'] ?></span></a>
        </div>

    </div>
</div><!-- КОНЕЦ Второстепенные новости на главной -->

<?php $this->widget('application.components.main.mbanner', array('position' => 8)); ?>

<div class="row-fluid" id="mainnewslist" style="margin-bottom: 10px;">
    <div class="span12 well" >
        <?php foreach ($politics as $politic): $i++; ?>
            <?php if ($i % 3 == 0 and $i != 0) : ?>
            </div>
        </div>
        <?php $this->widget('application.components.main.mbanner', array('position' => $p++)); ?>

        <div class="row-fluid" id="mainnewslist" style="margin-bottom: 10px;">
            <div class="span12 well" >
            <?php endif; ?>
            <div class="row-fluid" style="margin-bottom: 5px;">
                <div class="span3">
                    <a href="<?php echo Article::model()->getArticlestriplink($politic); ?>" class="thumbnail margin">
                        <div style="width:100%; height: 86px; background: url(<?php echo Article::model()->getImgpath($politic['id'], $politic['created'], true, false, '_cat');
            ?>) no-repeat center center"></div>

                    </a>
                </div>
                <div class="span9">
                    <h2 class="news-h2">
                        <a class="main-news-link" href="<?php echo Article::model()->getArticlestriplink($politic); ?>">
                            <?php echo trim($politic['title']); ?>
                        </a>
                    </h2>
                    <p><?php echo $politic['introtext'] ?></p>


                    <span class="created"><?php echo Helper::getFormattedtime($politic['publish'], false, true) ?></span>&nbsp;&nbsp;
                    <a href="news/<?php echo $politic['alias'] ?>"<span class="created"><?php echo $politic['fullname'] ?></span></a>&nbsp;&nbsp;
                    <span class="i-view"><?php echo $politic['hits'] ?></span>
                    <a href="<?php echo Article::model()->getArticlestriplink($politic); ?>#comments"><span class="i-comment"><?php echo $politic['comment_count'] ?></span></a>
                </div>
            </div>
        <?php endforeach; ?>
                <div id="123"></div>
    </div>
    <div class="clr"></div>
    <br />
    <div class="row-fluid" style="text-align: center">

        <?php
        echo Chtml::form();
        echo CHtml::hiddenField('page2', '2', array('autocomplete' => 'off'));
        echo Chtml::ajaxLink('Больше новостей', array('ajax/getmainnews'), array(
            'type' => 'POST',
            'id' => 'morenewsbutton',
            #'update' => '#ph',
            'beforeSend' => 'function(){
                        var page =  parseInt($("#page2").attr("value"));
                        now = page + 1;
                        $("#page2").attr("value", now);
                        $("#morenewsbutton").addClass("loading");
                    }',
            'complete' => 'function(){
                       $("#morenewsbutton").removeClass("loading");

                    }',
            'success' => "function(html){
                            $('#123').append(html);
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
