<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h6 class="block-header">Последние комментарии</h6>
<div class="well block-comment block-style">
    <ul class="unstyled" style="">

        <?php foreach ($this->items as $item): ?>
            <li>
                <a href="<?php echo Article::model()->getArticlestriplink($item); ?>#comment-<?php echo $item['cid'] ?>" style="font-size:12px;">
                    <!-- <span class="time"><?php echo $item['hits'] ?></span> -->
                    <span class="time2"><?php echo Helper::getFormattedtime($item['created'], false, true) ?></span> от
                    <span class="block-commen-author"><?php echo $item['name']  ?></span><br />
                    <span><?php echo Helper::trimText($item['text']) ?></span>
                </a>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</div>

