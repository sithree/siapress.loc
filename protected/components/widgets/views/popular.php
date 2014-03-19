<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    jQuery(function($) {
        $('.navii').click(function() {
            rel = $(this).attr('rel');
            if (rel == 'mostreading') {
                $(this).text('читаемые');
                $('[rel="mostcomment"]').text('комментируемые');
                $('[rel="lastcomment"]').text('последние');
            } else
            if (rel == 'lastcomment') {
                $(this).text('последние');
                $('[rel="mostcomment"]').text('комментируемые');
                $('[rel="mostreading"]').text('читаемые');
            } else
            if (rel == 'mostcomment') {
                $(this).text('комментируемые');
                $('[rel="mostreading"]').text('читаемые');
                $('[rel="lastcomment"]').text('последние');
            }

            $('.navii').removeClass('block-header');
            $('.navii').removeClass('active');

            $('.navii').addClass('popular-mini');

            $(this).addClass('block-header');
            $(this).addClass('active');
            $(this).removeClass('popular-mini');
            $('.mtab').css('display', 'none');
            $('#' + rel).css('display', 'block');
            return false;
        });

    });
</script>

<div class="widget gray-border-light main-news popular">
    <div class="header">
        <h2>
            <a rel="lastcomment" class="block-header navii active"  href="#">последние</a>
            <a href="#" rel="mostreading" class="popular-mini navii">читаемые</a>
            <a rel="mostcomment" class="popular-mini navii"  href="#">комментируемые</a>
        </h2>
    </div>

    <div  style="display:none;" id="mostcomment" class="well block-comment mtab">
        <ul class="unstyled popular">
            <?php foreach ($this->pop as $item): ?>
                <li>
                    <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                        <?php echo Helper::getLight($item); ?>
                    </a>

                <nobr>
                    <span class="created">[<?php echo Article::model()->getCategoryname($item['cat_id']); ?>]
                        [<?php echo $item['count'] ?>]</span>
                </nobr>

                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>

    <div style="display:none;" id="mostreading" class="well block-comment mtab">
        <ul class="unstyled popular">
            <?php foreach ($this->items as $item): ?>
                <li>
                    <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                        <!-- <span class="time"><?php echo $item['hits'] ?></span> -->
                        <?php echo Helper::getLight($item); ?>
                    </a>
                <nobr>
                    <span class="created">[<?php echo Article::model()->getCategoryname($item['cat_id']); ?>]
                        [<?php echo $item['hits'] ?>]</span>
                </nobr>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>

    <div id="lastcomment" class="well block-comment mtab">
        <ul class="unstyled">
            <?php
            foreach ($this->last as $item):
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