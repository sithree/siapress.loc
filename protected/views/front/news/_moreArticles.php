

<?php if ($model): ?>
    <hr />
    <h4>Читайте также:</h4>
    <br />

    <div class="row-fluid">
        <?php foreach ($model as $item) : ?>
            <div class="col-xs-4">
                <a href="<?php echo $item->link(); ?>">
                    <p><?php echo $item->imageV2(118, 86, true); ?>
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

