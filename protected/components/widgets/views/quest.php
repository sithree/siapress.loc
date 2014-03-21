<?php if ($items): ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/scripts/carousel.js", CClientScript::POS_END); ?>
    <script type="text/javascript">
        jQuery(function($) {
            $('#carousel-example-generic').carousel();
        });
    </script>
    
    <div class="widget carousel slide" id="carousel-example-generic" data-ride="carousel">
        <div class="header">
            <h2>Задай вопрос</h2>
            <ol class="carousel-indicators">
                <?php foreach ($items as $key => $item) { ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key ?>" <?php if ($key == 0) echo 'class="active"' ?>></li>
                <?php } ?>
            </ol>
        </div>
        <div class="carousel-inner">
            <?php foreach ($items as $key => $item) { ?>
                <div class="item well block-comment block-style <?php if ($key == 0) echo 'active' ?>">
                        <?php echo $item->imageV2(270,220) ?>
                    <div>
                        <h2 class="news-h2">
                            <a href="<?php echo Article::model()->getArticlestriplink($item); ?>">
                                <?php echo $item->title ?>              
                            </a>
                        </h2>

                    </div>
                    <div class="blogs-block row">
                        <div class="col-xs-7">
                            <a title="Задать вопрос" href="<?php echo Article::model()->getArticlestriplink($item); ?>">Задать вопрос <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                        <div class="col-xs-5  a-right">
                            <span><i class="fa fa-comment"></i> <?php echo count($item->comments); ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>

