
<h2><?php echo $theme->name; ?></h2>


<?php if ($model): ?>
    <?php foreach ($model as $item): ?>
        <?php $this->renderPartial('application.views.front.article._item_themes', array('item' => $item)); ?>
    <?php endforeach; ?>
<?php else: ?>
<hr />
<p>В настоящий момент не найдено записей по этой теме.</p>

<?php endif; ?>


