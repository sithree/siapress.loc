<div id="hot">
    Горячие темы:&nbsp;
    <?php foreach ($model as $item): ?>
        <a href="/themes/<?php echo $item->id ?>"><?php echo $item->name; ?></a>&nbsp;
    <?php endforeach; ?>
</div>