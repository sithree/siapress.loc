<div class="widget no-padding" id="opinion">
    <div class="header">
        <h2><a href="/opinion">Мнения</a></h2>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?php
            $i = 0;
            if ($model) {
                foreach ($model as $item) {
                    Yii::app()->controller->renderPartial('application.components.widgets.views._blogs_form', array('model' => $item, 'i' => $i++));
                }
            }
            ?>
        </div>
        <div class="col-xs-6">
            <div style="margin-bottom: 10px; position:relative;">
                <?php if(date('w') == 5 and date('H') == 15):?>
                <span id="sayOnline">ONLINE</span>
                <?php endif; ?>
                <a href="/say/<?php echo Yii::app()->db->createCommand("SELECT id from {{articles}} where cat_id = 21  order by id desc limit 1")->queryScalar() ?>">
                    <img style="max-width: 100%;" src="images/news/main/30520.jpg" />
                </a>
            </div>
            <?php
            $i = 1;
            if ($model) {
                foreach ($model as $item) {
                    Yii::app()->controller->renderPartial('application.components.widgets.views._blogs_form', array('model' => $item, 'i' => $i++));
                }
            }
            ?>
        </div>
    </div>
    <div id="loadOpinions"></div>
    
    <a id="moreOpinions" class="gray-light-button" href="/opinion">Больше мнений</a>
</div>

