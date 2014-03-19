<?php
#Yii::app()->cache->flush();
$this->layout = '//layouts/news/article';
$this->setPageTitle($model['title'] . ' — ' . Article::model()->getCategoryFullname($model['cat_id'])); #; . Yii::app()->name);
?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a[rel=gallery]',
    'config' => array(),
        )
);
?>
<?php $this->widget('application.components.main.mbanner', array('position' => 7)); ?>
<?php
#echo CHtml::tag('h1', array('class' => 'title'), $model['title'] . ' ' . CHtml::link('', array('news/'), array('class' => 'icon icon-print', 'title' => 'Версия для печати'))
echo CHtml::tag('h1', array('class' => 'title'), $model['title']);
?>
<?php echo strlen($model['introtext']) > 8 ? CHtml::tag('h3', array('class' => 'introtext'), $model['introtext']) : ''; ?>
<p style="text-align: right; margin-top: 10px">
    <a href="<?php echo Yii::app()->request->getHostInfo() . Yii::app()->request->getRequestUri() ?>#comments">Перейти к комментариям</a></p>
<hr />
<?php #$this->widget('application.components.main.mbanner', array('position' => 7)); ?>

<?php
if (is_file('images/news/main/' . $model['id'] . '_item.jpg') && empty($model['video'])):
    if (is_file('images/news/main/' . $model['id'] . '.jpg')):
        ?>
        <div class="news-image-container">
            <a title="<?php echo ($model['imgtitle']) ? CHtml::encode($model['imgtitle']) : CHtml::encode($model['title']) ?>" rel="gallery" href="images/news/main/<?php echo $model['id'] ?>.jpg">
                <img title="<?php echo CHtml::encode($model['title']) ?>" alt="<?php echo CHtml::encode($model['title']) ?>" src="images/news/main/<?php echo $model['id'] ?>_item.jpg" class="newsimage" /></a>
            <?php if ($model['imgtitle']): ?>
                <span class="imgtitle"><?php echo CHtml::encode($model['imgtitle']) ?></span>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="news-image-container">
            <img alt="<?php echo CHtml::encode($model['title']) ?>" src="images/news/main/<?php echo $model['id'] ?>_item.jpg" class="newsimage" />
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


<?php echo CHtml::tag('div', array('class' => 'fulltext'), $model['fulltext']); ?>
<?php echo CHtml::tag('div', array('class' => 'authorbottom'), Article::model()->getArticleauthor($model)); ?>
<hr />
<b><?php echo Helper::getFormattedtime($model['publish']) ?>  [Сургут]</b>, просмотров: <?php echo ($model['hits']) ? $model['hits'] : 'не известно'; ?>, комментариев: <?php echo $model['comment_count'] ?>
<hr />
<?php $this->widget('application.components.main.mbanner', array('position' => 14)); ?>

<!-- Социальные кнопки -->
<?php include Yii::getPathOfAlias('application.views.front.social') . DIRECTORY_SEPARATOR . 'social.php'; ?>
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
<?php if ($model['comment_count'] > 0): ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии: <a title="Подписаться на RSS - ленту комментариев этой новости" href="#"><span class="label label-warning">RSS</span></a></div>
<?php else: ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментариев пока нет.</div>
<?php endif; ?>


<?php
if (count($comments > 0)) {
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
else :
    ?>
    <h3>Комментарии закрыты.</h3>
<?php endif; ?>