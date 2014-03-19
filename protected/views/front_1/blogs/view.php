<?php
#Yii::app()->cache->flush();
$this->layout = '//layouts/news/article';
$this->setPageTitle($model['title']); #; . Yii::app()->name);
$this->addMetaProperty('og:title', $model['title']);
$this->addMetaProperty('og:type', 'article');
$this->addMetaProperty('og:description', $model['introtext']);
$this->addMetaProperty('og:url', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
(is_file('images/news/main/' . $model['id'] . '_item.jpg')) ? $this->addMetaProperty('og:image', 'http://' . $_SERVER['SERVER_NAME'] . '/images/news/main/' . $model['id'] . '_item.jpg') : '';
$this->addMetaProperty('og:site_name', Yii::app()->name);
?>


<?php $this->widget('application.components.main.mbanner', array('position' => 7)); ?>

<div itemscope itemtype="http://schema.org/Article">
    <article class="hentry">
        <header>
            <?php echo CHtml::tag('h1', array('class' => 'title entry-title', 'itemprop' => 'name'), $model['title']); ?>
            <?php echo strlen($model['introtext']) > 8 ? CHtml::tag('h3', array('class' => 'introtext entry-summary', 'itemprop' => 'description headline'), $model['introtext']) : ''; ?>
            <time itemprop='datePublished' class="published" style="display: none;" datetime="<?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?>" pubdate><?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?></time>
            <time itemprop='dateModified' class="updated" style="display: none;" datetime="<?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?>" update><?php echo date('Y-m-d H:i:s-0600', strtotime($model['publish'])); ?></time>
            <div class="tags" style="display: none;"><?php echo $model['tags']; ?></div>
        </header>

        <p style="text-align: right; margin-top: 10px">
            <?php if (Yii::app()->user->checkAccess('administrator')): ?>
                <a target="_blank" href="/admin.php?r=article/edit&id=<?php echo $model['id']; ?>">Редактировать в админке</a> | 
            <?php endif; ?>
            <a href="<?php echo Yii::app()->request->getHostInfo() . Yii::app()->request->getRequestUri() ?>#comments">Перейти к комментариям</a>
        </p>

        <hr />
        <?php #$this->widget('application.components.main.mbanner', array('position' => 7)); ?>

        <?php # echo Article::model()->getArticleimage($model); ?>

        <?php
        $this->widget('application.extensions.fancybox.EFancyBox', array(
            'target' => 'a[rel=gallery]',
            'config' => array(),
                )
        );
        ?>




        <div class='entry-content'>
            <?php
            if (is_file('images/news/main/' . $model['id'] . '_item.jpg') && empty($model['video'])):
                if (is_file('images/news/main/' . $model['id'] . '.jpg')):
                    ?>
                    <div class="news-image-container">
                        <figure style="margin: 0;">
                            <a title="<?php echo ($model['imgtitle']) ? CHtml::encode($model['imgtitle']) : CHtml::encode($model['title']) ?>" rel="gallery" href="images/news/main/<?php echo $model['id'] ?>.jpg">
                                <img title="<?php echo CHtml::encode($model['title']) ?>" alt="<?php echo CHtml::encode($model['title']) ?>" itemprop='image' src="images/news/main/<?php echo $model['id'] ?>_item.jpg" class="newsimage" /></a>
                            <?php if ($model['imgtitle']): ?>
                                <figcaption><span class="imgtitle"><?php echo CHtml::encode($model['imgtitle']) ?></span></figcaption>
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php else: ?>
                    <div class="news-image-container">
                        <figure style="margin: 0;">
                            <img alt="<?php echo CHtml::encode($model['title']) ?>" src="images/news/main/<?php echo $model['id'] ?>_item.jpg" itemprop='image' class="newsimage" />
                            <?php if ($model['imgtitle']): ?>
                                <figcaption><span class="imgtitle"><?php echo CHtml::encode($model['imgtitle']) ?></span></figcaption>
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php
                endif;
            endif;
            ?>

           <?php if (!empty($model['video'])): ?>       
                <?php $this->renderPartial('application.views.front.news._player', array('model' => $model)); ?>
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
            <?php echo CHtml::tag('span', array('class' => 'authorbottom fn'), Article::model()->getArticleauthor($model)); ?>
        </p>

        <meta itemprop="copyrightHolder" content="СИА-ПРЕСС: www.siapress.ru" >
        <meta itemprop="typicalAgeRange" content="12+" >







        <div class="clr"></div>
        <hr />

        <b><?php echo Helper::getFormattedtime($model['publish']) ?>  [Сургут]</b>, просмотров: <?php echo ($model['hits']) ? $model['hits'] : 'не известно'; ?>, комментариев: <?php echo $model['comment_count'] ?>
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

<?php $this->widget('application.components.main.mbanner', array('position' => 14)); ?>

<!-- Социальные кнопки -->
<?php include Yii::getPathOfAlias('application.views.front.social') . DIRECTORY_SEPARATOR . 'social.php'; ?>
<?php #include Yii::app()->basePath . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'social' . DIRECTORY_SEPARATOR . 'social.php';    ?>
<!-- End.Социальные кнопки -->


<hr />
<div id="rontar_adplace_4999"></div>
<script type="text/javascript"><!--
 
    (function (w, d, n) {
        var ri = { rontar_site_id: 1717, rontar_adplace_id: 4999, rontar_place_id: 'rontar_adplace_4999', adCode_rootUrl: 'http://adcode.rontar.com/' };
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
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии: <a title="Подписаться на RSS - ленту комментариев этой новости" href="#"><span class="label label-warning">RSS</span></a></div>
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