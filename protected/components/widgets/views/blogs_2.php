<div class="widget no-padding" id="opinion">
    <div class="header">
        <h2><a href="/opinions">Мнения</a></h2>
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
            <div style="margin-bottom: 10px;">
                <a href="/">
                    <img style="max-width: 100%;" src="http://www.siapress.ru/images/news/main/30520.jpg" />
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
</div>