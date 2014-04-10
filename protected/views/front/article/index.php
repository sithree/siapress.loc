<?php
$this->breadcrumbs = array(
    'Articles',
);

if ($category['fullname'])
    $this->setPageTitle($category['fullname']);
?>
<?php if (empty($dataProvider)): ?>
    <h2 class="headtitle">Пока нет записей в этой категории</h2>
<?php else: ?>
    <h2 class="headtitle"><?php echo $category['fullname'] ? $category['fullname'] : $this->pageTitle ?></h2>
<?php endif; ?>
<?php
if (!empty($mainNews)) {
    $item = $mainNews;
    ?>
    <hr />
    <div class="row head-news clearfix">
        <?php
        //echo $item->imageV2(128, 128, true);
        $image = Article::imageSV2($item['id'], $item['title'], 230, 0, true);
        if ($image): $span = true;
            ?>
            <div class="col-xs-5">
            <?php echo CHtml::link($image, array($category['alias'] . '/' . $item['id'])); ?>
            </div>
            <?php elseif ($item['cat_id'] == 9): ?>
            <div class="col-xs-5">
            <?php echo CHtml::link($image, array($category['alias'] . '/' . $item['id'])); ?>
            </div>
    <?php endif; ?>
        <div class="<?php echo 'col-xs-' . ($span ? "7" : "12") ?>">
            <h2><?php echo CHtml::link($item['title'] . '<br />', array($category['alias'] . '/' . $item['id'])); ?>

            </h2>
            <p><?php echo $item['introtext']; ?></p>
            <footer class="fbottom clearfix">
                <div class="col-xs-8"><?php // echo $item->author_alias ? $item->author_alias : $item->author0->name            ?>
                    <nobr><span class="nowrap"><?php echo Helper::getFormattedtime($item['created'], false, true); ?></span></nobr>
                </div>
                <div class="col-xs-4 a-right">
                    <i class="fa fa-eye"></i> <?php echo $item['hits']; ?> <i class="fa fa-comment"></i> <?php echo $item['comment_count'] ?>            </div>
            </footer>
        </div>
    </div>
    <?php
}
?>


<?php foreach ($dataProvider as $item): ?>
    <?php $this->renderPartial('_item', array('item' => $item)); ?>
<?php endforeach; ?>
<hr />
<div class="pagination ">
    <?php
    $this->widget('bootstrap.widgets.BootPager', array(
        'pages' => $pages
    ));
    ?>
</div>
