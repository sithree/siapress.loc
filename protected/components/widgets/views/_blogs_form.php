<?php if ($i % 2 == 0): ?>
    <div class="opinion-block"> 
        <header class="clearfix">

            <a href="<?php echo (Article::model()->getCategoryAlias($model->cat_id) === "say" or Article::model()->getCategoryAlias($model->cat_id) === 'lections' ) ? "/news" : ""; ?><?php echo Yii::app()->createUrl(Article::model()->getCategoryAlias($model->cat_id) . '/' . $model->id) ?>">
                <?php
                $img = $model->imageV2(70, 70, true);
                if ($img)
                {
                    echo $img;
                }
                else
                if (is_file("/images/users/blog/" . $model->author . '.jpg')):
                    ?>
                    <img src="<?php echo "/images/users/blog/" . $model->author . '.jpg'; ?>" alt="<?php echo (!empty($model->author_alias)) ? $model->author_alias : $model->author0->name ?>" />
                <?php endif; ?>
            <h3><?php echo $model->title; ?></h3>
        </a>
        <?php if (strlen($model->introtext) > 10): ?> 
            <div class="blogfulltext"><?php echo $model->introtext ?></div>
<?php endif; ?>
    </header>
    <footer>
        <div class="row">
            <div class="col-xs-8"><?php echo (!empty($model->author_alias)) ? $model->author_alias : $model->author0->name ?>, 
                <nobr><span class="nowrap"><?php echo Helper::getFormattedtime($model->created, false, false) ?></span></nobr>
            </div>
            <div class="col-xs-4 a-right">
                <i class="fa fa-eye"></i> <?php echo $model->articleAdd->hits; ?> <i class="fa fa-comment"></i> <?php echo count($model->comments); ?>
            </div>
        </div>
    </footer>
</div>
<?php endif; ?>
