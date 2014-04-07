<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    jQuery(function($) {


    });
</script>

<div class="widget gray-border-light main-news popular">
    <div class="header">
        <h2>
            <a rel="lastcomment" class="block-header navii active"  href="#">последние комментарии</a>
            <a href="#" rel="mostreading" class="popular-mini navii">читаемые</a>
            <a rel="mostcomment" class="popular-mini navii"  href="#">комментируемые</a>
        </h2>
    </div>

    <div  style="display:none;" id="mostcomment" class="block-comment mtab">
        <ul class="unstyled popular">
            <?php foreach ($pop as $item): ?>
                <li>
                    <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                        <?php echo Helper::getLight($item); ?>
                    </a>

                    <div class="small a-right">
                           <span class="nowrap"><?php echo Helper::getFormattedtime($item['created'], false, true) ?></span>, 
                   
                            <i class="fa fa-comment-o"></i> <?php echo $item['count'] ?>
                      </div>



                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>

    <div style="display:none;" id="mostreading" class="block-comment mtab">
        <ul class="unstyled popular">

            <?php foreach ($items as $item): ?>
                <li>
                    <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                        <!-- <span class="time"><?php echo $item->articleAdd->hits ?></span> -->
                        <?php // echo $item['title'] ?>
                        <?php echo Helper::getLight($item); ?>
                    </a>
                    <div class="small a-right">
                        <span class="nowrap"><?php echo Helper::getFormattedtime($item['created'], false, true) ?>, 
                            <i class="fa fa-eye"></i> <?php echo $item['hits'] ?>
                    </div>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>

    <div id="lastcomment" class="block-comment mtab">
        <ul class="unstyled">
            <?php
            foreach ($last as $item):
                if (!empty($item['parent']) and $item['parent'] !== 0) {
                    $parent = Comment::model()->findByPk($item['parent']);
                } else {
                    $parent = false;
                }
                ?>
                <li>
                    <div class="block-commen-author"><?php echo $item['name'] ?><?php echo $parent ? ' <span style="color: #333;"> &rarr; ' . $parent->name . ':</span>' : ':' ?></div>
                    <a  class="comm-right" href="<?php echo Article::model()->getArticlestriplink($item); ?>#comment-<?php echo $item['cid'] ?>">
                        <?php echo Helper::trimText($item['text']) ?>                       
                    </a>          
                    <div class="created">
                        <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                            <?php echo $item['title'] ?>
                        </a>
                    </div>
                    <div class="created"><?php echo Helper::getFormattedtime($item['created'], false, true) ?></div>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>
</div>