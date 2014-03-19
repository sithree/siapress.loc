<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h6 class="margin red-b">Самые популярные</h6>
<ul class="unstyled popular">
    <?php foreach ($this->items as $item): ?>
        <li>
            <a href="<?php echo Article::model()->getArticlestriplink($item); ?>" class="popular">
                <span class="time"><?php echo $item['hits'] ?></span>
                <?php echo Helper::getLight($item); ?>
            </a>
        </li>
        <?php
    endforeach;
    ?>
</ul>
<hr />
