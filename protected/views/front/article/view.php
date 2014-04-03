<script>
    jQuery(function($) {
        $("#center iframe").attr('width', 477);

    });
</script>

<aside>
    <div id="rontar_adplace_5711" style="margin-bottom: 10px;"></div>
    <script type="text/javascript"><!--

        (function(w, d, n) {
            var ri = {rontar_site_id: 1717, rontar_adplace_id: 5711, rontar_place_id: 'rontar_adplace_5711', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
</aside>

<div itemscope itemtype="http://schema.org/Article">
    <article class="hentry">
        <header>
            <?php echo CHtml::tag('h1', array('class' => 'title entry-title', 'itemprop' => 'name'), $model['title']); ?>
            <?php echo strlen($model['introtext']) > 8 ? CHtml::tag('h3', array('class' => 'introtext entry-summary', 'itemprop' => 'description headline'), $model['introtext']) : ''; ?>
            <time itemprop='datePublished' class="published" style="display: none;" datetime="<?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?>" pubdate><?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?></time>
            <time itemprop='dateModified' class="updated" style="display: none;" datetime="<?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?>" update><?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?></time>
            <div class="tags" style="display: none;"><?php echo $model['tags']; ?></div>
        </header>
        <?php if (Yii::app()->user->checkAccess('administrator')): ?>
            <p style="text-align: right; margin-top: 10px">
                <a target="_blank" href="/admin.php?r=article/edit&id=<?php echo $model['id']; ?>">Редактировать в админке</a> 
            </p>
        <?php endif; ?>



        <?php
        $this->widget('application.extensions.fancybox.EFancyBox', array(
            'target' => 'a[rel=gallery]',
            'config' => array(),
                )
        );
        ?>

        <div class='entry-content' style="position: relative">
            <?php
            Yii::beginProfile('$image');
            $image = Article::imageSV2($model['id'], $model['imgtitle'], 230, 0, true);
            if ($image && empty($model['video'])):
                ?>
                <div class="news-image-container">
                    <figure style="margin: 0;">
                        <a title="<?php echo ($model['imgtitle']) ? CHtml::encode($model['imgtitle']) : CHtml::encode($model['title']) ?>" rel="gallery" href="images/news/main/<?php echo $model['id'] ?>.jpg">
                            <?php echo $image; ?></a>
                        <?php if ($model['imgtitle']): ?>
                            <figcaption><span class="imgtitle"><?php echo CHtml::encode($model['imgtitle']) ?></span></figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
            <?php elseif (is_file("images/news/main/" . $model['id'] . "jpg")): ?>
                <div class="news-image-container">
                    <figure style="margin: 0;">
                        <img alt="<?php echo CHtml::encode($model['title']) ?>" src="images/news/main/<?php echo $model['id'] ?>.jpg" itemprop='image' class="newsimage" />
                        <?php if ($model['imgtitle']): ?>
                            <figcaption><span class="imgtitle"><?php echo CHtml::encode($model['imgtitle']) ?></span></figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
                <?php
            endif;
            Yii::endProfile('$image');
            ?>
            <?php if (!empty($model['video'])): ?>       
                <?php $this->renderPartial('_player', array('model' => $model)); ?>
            <?php endif; ?>

            <?php
            //Выводит сожержание
            require Yii::getPathOfAlias('application.views.front.news') . '/_nav.php';
            ?>

            <div class="fulltext" itemprop='articleBody'>
                <?php echo $model['fulltext'] ?>
            </div>
        </div>


        <?php if ($photos): ?>
            <hr />
            <div id="ph" class="row-fluid">
                <?php
                foreach ($photos[1] as $key => $photo):
                    ?>
                    <div class="exclusive">
                        <a rel="gallery" href="<?php echo $photos[0][$key]; ?>" style="display: block; background: #fbfbfb; width: 100%; height: 100%;" classs="ex_link">
                            <div class="news-image-container"><img itemprop='associatedMedia' alt="<?php $item['title'] ?>" src="<?php echo $photo; ?>" class="newsimage"><span class="imgtitle"></span></div>
                            <div class="ex_cont" style="margin-top: 123px;">
                                <div class="ex_head">Увеличить</div>
                                <div class="ex_desc"></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        endif;
        ?>
        <br />

        <p class="byline author vcard" itemprop="author" id="author">
            <?php echo CHtml::tag('span', array('class' => 'authorbottom fn'), $model->getAuthor()); ?>
        </p>

        <meta itemprop="copyrightHolder" content="СИА-ПРЕСС: www.siapress.ru" >
        <meta itemprop="typicalAgeRange" content="16+" >

        <div class="clr"></div>
        <hr />

        <b><?php echo Helper::getFormattedtime($model['publish']) ?></b>, 
        просмотров: <?php echo $model->articleAdd->hits ? $model->articleAdd->hits : 'не известно'; ?>, 
        комментариев: <?php echo count($comments) ?>
        <!--<br>
        <?php //if (!Yii::app()->request->cookies['comment_' . $model->id]->value AND ! isset(Yii::app()->session['comment_' . $model->id])): ?>
            <a class="likebutton" rel="<?php //echo $model->id ?>" title="Нравится" href="#"><i class="fa fa-thumbs-up"></i> нравится</a>
            <a class="dislikebutton"  rel="<?php //echo $model->id ?>" title="Не нравится" href="#"><i class="fa fa-thumbs-down"></i> не нравится</a>
            <span id="<?php //echo $model->id ?>" class="like-result <?php //echo $class ?>"><?php //echo $model->rating ?></span>
        <?php //else: ?>
            <span id="<?php //echo $model->id ?>" class="like-result <?php //echo $class ?>"><?php //echo $model->rating ?></span>
        <?php //endif; ?>-->
    </article>
</div>

<hr />
<?php
$poll = Poll::model()->find('article_id = ' . $model['id']);
if ($poll):
    ?>
    <div class="row-fluid">
        <div class="span12 poll">
            <?php $this->widget('EPoll', array('poll_id' => $poll->id)); ?>
        </div>
    </div>
<?php endif; ?>

<!-- Социальные кнопки -->
<?php include Yii::getPathOfAlias('application.views.front.social') . DIRECTORY_SEPARATOR . 'social.php'; ?>

<!-- End.Социальные кнопки -->


<?php
//$this->renderPartial('_moreArticles', array('model' => $moreArticles));
?>

<hr />
<div id="rontar_adplace_5713"></div>
<script type="text/javascript"><!--

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 5713, rontar_place_id: 'rontar_adplace_5713', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
<hr />

<a id="comments"></a>
<?php if (count($comments) > 0): ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии:</div>
<?php else: ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментариев пока нет.</div>
<?php endif; ?>


<?php
if (count($comments) > 0) {
    $this->renderPartial('/comments/comments', array(
        'comments' => $comments,
    ));
}
?>
<hr />
<!-- Форма добавления комментария -->
<?php if (isset($commentform) AND Yii::app()->params->comments == true and $model['comment_on'] == 1): ?>
    <a id="addcomment"></a>
    <?php
    $this->renderPartial('application.views.front.comments._form', array(
        'commentform' => $commentform,
        'model' => $model
    ));
else:
    if (empty($model['comment_ban'])):
        ?>
        <h3>Комментарии закрыты.</h3>
    <?php else: ?>
        <h3><?php echo $model['comment_ban'] ?></h3>
    <?php endif; ?>
<?php endif; ?>