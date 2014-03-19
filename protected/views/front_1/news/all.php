<?php
$this->layout = '//layouts/news/category';

$this->setPageTitle('Все новости Сургута');

//Добавляем код развертывания картинки в высоту
Yii::app()->getClientScript()->registerScript(__CLASS__ . '#', "
jQuery('.news-container').hover(function(){
    $(this).find('img').addClass('img_hovered');
}, function(){
    $(this).find('img').removeClass('img_hovered');
});
");
?>

<h2>Все новости Сургута и ХМАО<a title="RSS лента раздела Политика" href="/rss"><span class="label label-warning">RSS</span></a></h2>
<hr />

<?php foreach ($dataProvider as $item): ?>

    <?php # echo CVarDumper::dump($item);    ?>
    <div class="row-fluid news-container">
        <div class="span3" style="position:relative;">
            <div class="img_container">
                <?php #echo CHtml::link(Article::model()->getImgpath($item['id'], $item['created'], true, true), Articlte::model()->getLink($item));  ?>
                <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                    <?php echo Article::model()->getImgpath($item['id'], $item['created'], true, true, '_cat') ?>
                </a>
            </div>
        </div>
        <div class="span9">
            <h4><?php echo CHtml::link($item['title'] . '<br />', Article::model()->getArticlestriplink($item)); ?></h4>
            <p><?php echo $item['introtext']; ?></p>

            <div class="item_news_info">
                <?php if ($item['hits']) : ?>
                    <span title="Количество просмотров" class="i-view"><?php echo $item['hits']; ?></span>
                <?php endif; ?>
                <a title="<?php echo $item['comment_count'] > 0 ? "Перейти к комментариям" : "Оставить первый комментарий" ?>" href="<?php echo Article::model()->getArticlestriplink($item); ?>#comments"><span class="i-comment">
                        <?php echo $item['comment_count'] > 0 ? $item['comment_count'] : "Нет комментариев" ?></span>
                </a> |
                <?php
                    echo  CHtml::link(Article::model()->getCategoryname($item['cat_id']),
                            'news/' . Article::model()->getCategoryAlias($item['cat_id']
                            )) . ' | ';
                ?>

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
#new MPagination2(Article::model()->getCountitems(Article::model()->getNewscat()), ($_GET['id']) ? intval($_GET['id']) : '1');
?>
