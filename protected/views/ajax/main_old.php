<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="span5"><!-- Главная новость на главной -->
    <?php
    #$main = Article::model()->getMainitem('politics');
    ?>
    <a href="<?php echo Article::model()->getArticlestriplink($main); ?>" class="thumbnail margin">
        <img style="width: 260px;" src="<?php echo Article::model()->getImgpath($main['id'], $main['created'], true, false);
    ?>" alt="<?php echo $main['title'] ?>">
    </a>
    <h3 style="line-height: 115%; font-weight: normal" class="margin"><?php echo CHtml::link($main['title'], array('news/politics/' . $main['id'])); ?></h3>
    <p><?php echo $main['introtext'] ?></p>
    <a href="#"><span class="created"><?php echo Helper::getFormattedtime($main['created']) ?></span></a>&nbsp;&nbsp;
    <span class="i-view"><?php echo $main['hits'] ?></span>
    <a href="<?php echo Article::model()->getArticlestriplink($main); ?>#comments"><span class="i-comment"><?php echo $main['comment_count'] ?></span></a>
</div>
<div class="span7"><!-- Второстепенные новости на главной -->
    <?php
    #if ($this->beginCache('politics_mainpage')) {

    ?>
    <ul class="news margin unstyled">
        <?php foreach ($politics as $politic): ?>
            <li style="padding-left:0;">
                <div class="row-fluid">
                    <div class="span3">
                        <a href="#"><span class="created"><?php echo Helper::getFormattedtime($politic['created']) ?></span></a>
                    </div>
                    <div class="span9">
                        <?php echo Helper::getLink($politic); ?>
                        <span title="Всего просмотров" class="i-view"><?php echo $politic['hits'] ?></span>
                        <a  title="<?php echo $politic['comment_count'] > 0 ? "Перейти к комментариям" : "Оставить первый комментарий" ?>" href="<?php echo Article::model()->getArticlestriplink($politic); ?>#comments">
                            <span class="i-comment"><?php echo $politic['comment_count'] ?></span>
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
        <li style="padding-left:0;">
            <div class="row-fluid">
                <div class="span3">
                    &nbsp;
                </div>
                <div class="span9" style="margin-top:5px;">
                    Все <?php echo CHtml::link(' новости раздела «' . Article::model()->getCategoryname($main['cat_id']) . '» &rarr;',
                            array('news/' . Article::model()->getCategoryalias($main['cat_id']) . '/')) ?>
                </div>
            </div>
        </li>
    </ul>
    <?php
    #$this->endCache();
    #}
    ?>
</div><!-- КОНЕЦ Второстепенные новости на главной -->