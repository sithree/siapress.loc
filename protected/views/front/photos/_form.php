<div class="row-fluid" id="ph">
    <?php
    foreach ($items as $item):
        ?>
        <div class="exclusive">
            <a classs="ex_link" style="display: block; background: #ccc; width: 100%; height: 100%;"
               href="<?php echo Yii::app()->createUrl('photos/' . $item['id']); ?>">
                <?php echo Article::model()->getArticleimage($item); ?>
                <div style="margin-top: 123px;" class="ex_cont">
                    <div class="ex_head">
                        <?php echo $item['title'] ?>
                    </div>
                    <div class="ex_desc">
                        <?php echo Helper::trimText($item['fulltext']); ?>
                    </div>
                </div>
            </a>
        </div>
        <?php
    endforeach;
    ?>
</div>


