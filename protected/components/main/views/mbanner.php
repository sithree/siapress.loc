<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php if (isset($_GET['show_banner_position'])): ?>
    <div class="com" style="width: 100%; height: 50px; background: #ccc;"><?php echo $pos; ?>;</div>
<?php else: ?>
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <div class="com" style="position:relative;">
	    <noindex>				
                <?php
                if ($item->img) {
                    if ($item->link) {
                        echo "<a rel='nofollow' target='_blank' href='$item->link'><img src='media/com/$item->img' alt='На правах рекламы'  /></a>";
                    } else {
                        echo "<img src='media/com/$item->img' alt='На правах рекламы' />";
                    }
                } else {
                    echo $item->code;
                }
                ?>
            </noindex>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
