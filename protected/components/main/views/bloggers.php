<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row-fluid" style=""><!-- наши блоггеры -->
    <?php
    foreach ($items as $item):
        ?>
        <div class="span3">
            <div class="bloggers">
                <a title="Читать блог" href="<?php echo Yii::app()->createUrl(Article::model()->getCategoryAlias($item['cat_id']) . '/' . $item['id']) ?>" style="display: block;">
                    <img align="left" alt="<?php echo $item['name'] ?>" src="<?php echo User::model()->getAuthoravatar($item['author'], true); ?>">
                    <div class="bloggers-hidden">
                        <h4><?php echo $item['title'] ?></h4>
                        <span class="blog"><?php echo $item['name']; ?></span>
                        <div class="bloggers-view">Просмотры: <?php echo $item['hits'] ?><br />Комментарии: <?php echo $item['comment_count'] ?></div>
                    </div>
                </a>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div><!-- // наши блоггеры -->
