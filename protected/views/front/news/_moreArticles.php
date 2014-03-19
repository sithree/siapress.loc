

<?php if ($model): ?>
    <hr />
    <h4>Читайте также:</h4>
    <br />

    <div class="row-fluid">
        <?php foreach ($model as $item) : ?>
            <div class="span3">
                <a href="<?php echo $item->link(); ?>">
                    <p><img  src="<?php echo $item->getImgpath($item->id, $item->created, true, false, '_cat');


            ?>" alt="<?php echo $item->title ?>">
                    </p>
                    <h5><?php echo $item->title ?></h5>
                </a>
                <div class="created">
                    <?php echo Helper::getFormattedtime($item->publish) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

