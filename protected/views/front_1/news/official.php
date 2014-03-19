<?php
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
<h2>Предупреждение</h2>
<hr />
<ul>
    <li>
        <a href="news/notice/23708">Предупреждение от ООО «Газпром трансгаз Сургут»</a>
    </li>
</ul>
<hr />

<h2>Раскрытие информации</h2>
<hr />

<ul>
    <li><a href="<?php echo $this->createUrl('official/gazprom_sgt'); ?>">ООО «Газпром трансгаз Сургут»</a></li>
</ul>
<hr />

<h2><?php echo $category['fullname'] ?> <a title="RSS лента раздела Политика" href="/rss"></a></h2>
<hr />

<?php foreach ($dataProvider as $item): ?>
    <?php $img = Article::model()->getImgpath($item['id'], $item['created'], true, true, '_cat'); ?>
    <div class="row-fluid news-container">
        <div class="span12">
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
