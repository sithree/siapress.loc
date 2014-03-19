<?php if ($items): ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/scripts/bootstrap.js"); ?>
    <script type="text/javascript">
        jQuery(function($) {
            $('.carousel').carousel();
        });
    </script>
    <div class="widget carousel slide" id="carousel-example-generic"data-ride="carousel">
        <div class="header">
            <h2>Задай вопрос</h2>
            <ol class="carousel-indicators">
                <?php foreach ($items as $key => $item) { ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key ?>" <?php if ($key == 0) echo 'class="active">' ?></li>
                <?php } ?>
            </ol>
        </div>
        <div class="carousel-inner">
            <?php foreach ($items as $key => $item) { ?>
                <div class="item well block-comment block-style <?php if ($key == 0) echo 'active' ?>">
                    <img src="http://siapress.ru/<?php echo $item->getImgpath($item->id, $item->created, true, false, '_item'); ?>" alt="<?php echo $item->title ?>">
                    <div>
                        <h2 class="news-h2" style="font-size:12px; line-height: 135%; margin-top: 10px; margin-bottom:5px;">
                            <span style="font-size: 13px;
                                  border-bottom: none;
                                  font-weight: bold;" href="/news/economics/20145">
                                <?php echo $item->title ?>              </span>
                        </h2>
                        <div class="blogs-block">
                            <a title="Задать вопрос" href="<?php echo Article::model()->getArticlestriplink($item); ?>" style=" color: #333; border-bottom:none; font-size:12px;">Задать вопрос <i class="fa fa-arrow-circle-o-right"></i></a>
                            <span style="color:gray; position: absolute; right: 5px;"><i class="fa fa-comment"></i> <?php echo count($item->comments); ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
<?php endif; ?>

