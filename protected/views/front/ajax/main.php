<div class="widget b-light-gray main-news">
    <div class="header">
        <h2><a href="/news">Новости</a></h2>
    </div>
    <ul>
        <?php foreach ($model as $item): ?>
            <li>
                <header class="clearfix">
                    <?php
                    $image = $item->imageV2(68, 46, true);
                    if ($image):
                        ?>
                        <a href="<?php echo $item->link(); ?>">
                            <?php echo $image; ?>
                        </a>
                    <?php endif; ?>
                    <h3>
                        <a href="<?php echo $item->link() ?>"><?php echo CHtml::decode($item->title) ?></a>
                    </h3>
                </header>
                <footer class="row clearfix">
                    <div class="col-xs-8"><?php echo Helper::getFormattedtime($item->publish, false, true) ?></div>
                    <div class="col-xs-4 a-right"><i class="fa fa-eye"></i> <?php echo $item->articleAdd->hits   ?> <a href="<?php echo $item->link(); ?>#comments" class="tocomments"><i class="fa fa-comment"></i> <?php echo $item->totalComments;   ?></a></div>
                </footer>
            </li>
        <?php endforeach; ?>
    </ul>
</div>