<?php
$this->breadcrumbs = array(
    'Articles',
);

$this->menu = array(
    array('label' => 'Create Article', 'url' => array('create')),
    array('label' => 'Manage Article', 'url' => array('admin')),
);

$this->layout = '//layouts/news/category';

$this->setPageTitle($category['fullname'] . ' — ' . Yii::app()->name);


//Добавляем код развертывания картинки в высоту
Yii::app()->getClientScript()->registerScript(__CLASS__ . '#', "
jQuery('.news-container').hover(function(){
    $(this).find('img').addClass('img_hovered');
}, function(){
    $(this).find('img').removeClass('img_hovered');
});
");
?>
<h2><?php echo $category['fullname'] ?> <a title="RSS лента раздела Политика" href="/rss"><span class="label label-warning">RSS</span></a></h2>
<hr />
<?php
if (!empty($mainNews)) {
    $item = $mainNews;
    ?>
    <div class="row-fluid">
        <?php if (Article::model()->getImgpath($item['id'], $item['created'], true, false, '_main')): $span = true; ?>
            <div class="span5">
                <?php echo CHtml::link(Article::model()->getImgpath($item['id'], $item['created'], true, true, '_main'), array('news/' . $category['alias'] . '/' . $item['id'])); ?>
            </div>
        <?php elseif ($item['cat_id'] == 9): ?>
            <div class="span5">
                <?php echo CHtml::link(Article::model()->getImgpath($item['id'], $item['created'], true, true, '_main'), array('news/' . $category['alias'] . '/' . $item['id'])); ?>
            </div>
        <?php endif; ?>
        <div class="<?php echo $span ? "span7" : "span12" ?>">
            <h2><?php echo CHtml::link($item['title'] . '<br />', array('news/' . $category['alias'] . '/' . $item['id'])); ?>

            </h2>

            <p><?php echo $item['introtext']; ?></p>
            <div class="item_news_info">
                <span title="Количество просмотров" class="i-view"><?php echo $item['hits'] ?></span>
                <a title="<?php echo $item['comment_count'] > 0 ? "Перейти к комментариям" : "Оставить первый комментарий" ?>" href="<?php echo Article::model()->getArticlestriplink($item); ?>#comments">
                    <span class="i-comment"><?php echo $item['comment_count'] > 0 ? $item['comment_count'] : "Нет комментариев" ?></span>
                </a> |
                <a title="Искать записи по этой дате" href="#"><span class="created"><?php echo Helper::getFormattedtime($item['created'], false, true); ?> </span></a>
            </div>
        </div>
    </div>
    <hr />
    <?php
}
?>
<!-- 8 -->
<div id="rontar_adplace_4328"></div>
<script type="text/javascript"><!--
 
    (function (w, d, n) {
        var ri = { rontar_site_id: 1717, rontar_adplace_id: 4328, rontar_place_id: 'rontar_adplace_4328', adCode_rootUrl: 'http://adcode.rontar.com/' };
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
<!-- /// 8 -->

<?php foreach ($dataProvider as $item): ?>
    <?php $img = Article::model()->getImgpath($item['id'], $item['created'], true, true, '_cat'); ?>
    <div class="row-fluid news-container">
        <?php if ($img): ?>
            <div class="span3" style="position:relative;">
                <div class="img_container">
                    <?php echo CHtml::link(Article::model()->getImgpath($item['id'], $item['created'], true, true, '_cat'), array('news/' . $category['alias'] . '/' . $item['id'])); ?>
                </div>
            </div>
        <?php else: ?>
            <?php
            if ($item['cat_id'] == 9) {
                if (is_file('images/users/blog/' . $item['author'] . '.jpg')):
                    $img = 1;
                    ?>
                    <div class="span3" style="position:relative;">
                        <div class="img_container">
                            <?php echo CHtml::link('<img src="images/users/blog/' . $item['author'] . '.jpg" alt="Блог" />', array('news/' . $category['alias'] . '/' . $item['id'])); ?>
                        </div>
                    </div>
                    <?php
                    endif;
            }
            ?>
        <?php endif; ?>
        <div class="span<?php echo $img ? 9 : 12 ?>">
            <h4><?php echo CHtml::link($item['title'] . '<br />', array('news/' . $category['alias'] . '/' . $item['id'])); ?></h4>
            <p><?php echo $item['introtext']; ?></p>
            <div class="item_news_info">

                <span title="Количество просмотров" class="i-view"><?php echo $item['hits']; ?></span>
                <a title="<?php echo $item['comment_count'] > 0 ? "Перейти к комментариям" : "Оставить первый комментарий" ?>" href="<?php echo Article::model()->getArticlestriplink($item); ?>#comments"><span class="i-comment">
                        <?php echo $item['comment_count'] > 0 ? $item['comment_count'] : "Нет комментариев" ?></span>
                </a> |
                <a title="Искать по этой дате" href="#"><span class="created"><?php echo Helper::getFormattedtime($item['created'], false, true); ?> </span></a>
            </div>
        </div>
    </div>



    <?php
endforeach;
#$this->endCache();
#}
?>
<hr />
<div class="pagination ">
    <?php
    $this->widget('bootstrap.widgets.BootPager', array(
        'pages' => $pages,
        'cssFile' => true,
    ));
    ?>
</div>

<?php
#new MPagination(Article::model()->getCountitems($category['id']), $category['alias']);
?>
