<?php $image = $item->imageV2(222, 126, true); ?>
<div class="widget first-news  no-padding">
    <div class="header">
        <h2><a href="/mainnews">Главная новость</a></h2>
    </div>


    <div class="row">
        <?php if ($image): ?>
            <div class="col-xs-5">
                <a href="<?php echo $item->link(); ?>">
                    <?php echo $image; ?>
                </a>

            </div>
        <?php endif; ?>
        <div class="col-xs-<?php echo $image ? 7 : 12 ?>">
            <header class="clearfix">
                <h1>
                    <a href="<?php echo $item->link(); ?>"><?php echo CHtml::decode($item->title) ?></a>
                </h1>
            </header>
            <p><?php echo $item->introtext; ?></p>
        </div>
    </div>

    <div class="clearfix"></div>
    <footer class="clearfix ">
        <div class="row">
            <div class="col-xs-8"><a href="/<?php echo $item->getCategoryAlias(); ?>"><?php echo $item->getCategoryName() ?></a>, <?php echo Helper::getFormattedtime($item->modified, false, true) ?></div>
            <div class="col-xs-4 a-right"><i class="fa fa-eye"></i> <?php echo $item->articleAdd->hits ?> <a class="tocomments" href="<?php echo $item->link(); ?>#comments"><i class="fa fa-comment"></i> <?php echo count($item->comments); ?></a></div>
        </div>
    </footer>

</div>