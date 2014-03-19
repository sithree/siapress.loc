<?php
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


<h2>Блоги <a title="RSS лента раздела Политика" href="#"><span class="label label-warning">RSS</span></a></h2>
<hr />

<?php foreach ($dataProvider as $item): ?>

    <?php # echo CVarDumper::dump($item);    ?>
    <div class="row-fluid news-container">
        <div class="span3" style="position:relative;display: none">
            <div class="img_container">
                <?php echo CHtml::link(Article::model()->getImgpath($item['id'], $item['created'], true, true), array('blogs/' . $item['id'])); ?>
            </div>
        </div>
        <div class="span12">
            <h4><?php echo CHtml::link($item['title'] . '<br />', array('blogs/' . $item['id'])); ?></h4>
            <?php echo (mb_strlen($item['introtext']) > 6) ? "<p>" . $item['introtext'] . "</p>" : ""; ?>


            <div class="item_news_info">
                <span><?php echo $item['name']; ?></span> |
                <a title="Искать по этой дате" href="#"><span class="created"><?php echo Helper::getFormattedtime($item['created']); ?> </span></a> |
                <span title="Количество просмотров" class="i-view"><?php echo $item['hits']; ?></span>
                <a title="<?php echo $item['comment_count'] > 0 ? "Перейти к комментариям" : "Оставить первый комментарий" ?>" href="<?php echo Article::model()->getArticlestriplink($item); ?>#comments"><span class="i-comment">
                        <?php echo $item['comment_count'] > 0 ? $item['comment_count'] : "Нет комментариев" ?></span>
                </a>
            </div>
        </div>
    </div>



    <?php
endforeach;
#$this->endCache();
#}
?>
<hr />
<?php
#new MPagination(Article::model()->getCountitems($category['id']), $category['alias']);
?>


<?php /* $this->widget('bootstrap.widgets.BootListView',array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
  )); */ ?>
