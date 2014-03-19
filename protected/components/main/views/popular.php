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
                $(this).text('Самые читаемые');
                $('[rel="mostcomment"]').text('комментируемые');
                $('[rel="lastcomment"]').text('последние');
            } else
            if (rel == 'lastcomment') {
                $(this).text('Самые последние');
                $('[rel="mostcomment"]').text('комментируемые');
                $('[rel="mostreading"]').text('читаемые');
            } else
            if (rel == 'mostcomment') {
                $(this).text('Самые комментируемые');
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

<h6>
    <a rel="lastcomment" class="block-header navii active"  href="#">Самые последние</a>
    <a href="#" rel="mostreading" class="popular-mini navii">читаемые</a>
    <a rel="mostcomment" class="popular-mini navii"  href="#">комментируемые</a>
</h6>
<div class="clr"></div>

<div  style="display:none;" id="mostcomment" class="well block-comment mtab">
    <ul class="unstyled popular">
        <?php foreach ($this->pop as $item): ?>
            <li>
                <a href="<?php echo Article::model()->getArticlestriplink($item); ?>" style="font-size:12px;">
                    <!-- <span class="time"><?php echo $item['hits'] ?></span> -->
                    <?php echo Helper::getLight($item); ?>
                    <nobr>
                        <span style="font-size: 11px; color:gray; ">[<?php echo Article::model()->getCategoryname($item['cat_id']); ?>]
                            [<?php echo $item['count'] ?>]</span>
                    </nobr>
                </a>
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
                <a href="<?php echo Article::model()->getArticlestriplink($item); ?>" style="font-size:12px;">
                    <!-- <span class="time"><?php echo $item['hits'] ?></span> -->
                    <?php echo Helper::getLight($item); ?>
                    <nobr>
                        <span style="font-size: 11px; color:gray; ">[<?php echo Article::model()->getCategoryname($item['cat_id']); ?>]
                            [<?php echo $item['hits'] ?>]</span>
                    </nobr>
                </a>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</div>

<div id="lastcomment" class="well block-comment mtab">
    <ul class="unstyled" style="">
        <?php foreach ($this->last as $item):
            if(!empty($item['parent']) and $item['parent'] !== 0) {
                $parent = Comment::model()->findByPk($item['parent']);
               
            } else {
                $parent = false;
            }
            
            ?>
            <li>
                <a href="<?php echo Article::model()->getArticlestriplink($item); ?>#comment-<?php echo $item['cid'] ?>" style="font-size:12px;">
                    <span class="block-commen-author"><?php echo $item['name'] ?><?php echo $parent ? ' <span style="color: #333;"> &rarr; '. $parent->name  .':</span>' : ':' ?>
                    </span><br />
                    <span class="comm-right"><?php echo Helper::trimText($item['text']) ?>
                    </span>
                    <div class="clr"></div>
                    <span class="created"><?php echo $item['title'] ?></span>
                    <div class="clr"></div>
                    <span class="created" style=""><?php echo Helper::getFormattedtime($item['created'], false, true) ?></span>




                </a>
            </li>
    <?php
endforeach;
?>
    </ul>
</div>



<!-- <img alt="" src="http://placehold.it/270x290"> -->
