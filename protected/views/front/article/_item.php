<?php $image = Article::imageSV2($item['id'], $item['title'], 118, 86, true); ?>
    <div class="row news-container">
        <?php if ($image): ?>
            <div class="col-xs-3">
                <div class="img_container">
                    <?php echo CHtml::link($image, array(ArticleCategories::model()->getCategoryAlias($item['cat_id']) . '/' . $item['id'])); ?>
                </div>
            </div>
        <?php else: ?>
            <?php
            if ($item['cat_id'] == 9) {
                if (is_file('images/users/blog/' . $item['author'] . '.jpg')):
                    $img = 1;
                    ?>
                    <div class="col-xs-3">
                        <div class="img_container">
                            <?php echo CHtml::link('<img src="images/users/blog/' . $item['author'] . '.jpg" alt="Блог" />', array('news/' . $category['alias'] . '/' . $item['id'])); ?>
                        </div>
                    </div>
                    <?php
                endif;
            }
            ?>
        <?php endif; ?>
        <div class="col-xs-<?php echo ($image or is_file('images/users/blog/' . $item['author'] . '.jpg')) ? 9 : 12 ?>">
            <h2><?php echo CHtml::link($item['title'] . '<br />', array(ArticleCategories::model()->getCategoryAlias($item['cat_id']) . '/' . $item['id'])); ?></h2>
            <p><?php echo $item['introtext']; ?></p>

        </div>

    </div>

    <footer class="row fbottom clearfix">

        <div class="col-xs-8">
            <?php echo ArticleCategories::model()->getCategoryName($item['cat_id']); ?>, 
            <?php // echo $item->author_alias ? $item->author_alias : $item->author0->name         ?>
            <nobr><span class="nowrap"><?php echo Helper::getFormattedtime($item['created'], false, true); ?></span></nobr>
        </div>
        <div class="col-xs-4 a-right">
            <i class="fa fa-eye"></i> <?php echo $item['hits']; ?> <i class="fa fa-comment"></i> <?php echo $item['comment_count'] ?>            </div>

    </footer>


