<div class="widget no-padding" id="opinion">
    <div class="header">
        <h2><a href="/oldsurgut">Старый Суругут</a></h2>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?php $i = 0;
            if ($model) {
                foreach ($model as $item) {
                    Yii::app()->controller->renderPartial('application.components.widgets.views._op_form', array('model' => $item, 'i' => $i++));
                }
            } ?>  
        </div>
        <div class="col-xs-6">
            <?php $i = 1;
            if ($model) {
                foreach ($model as $item) {
                    Yii::app()->controller->renderPartial('application.components.widgets.views._op_form', array('model' => $item, 'i' => $i++));
                }
            } ?>
        </div>
    </div>
    <div id="loadOpinions"></div>
    <a id="moreOpinions" class="gray-light-button" href="/oldsurgut">Больше Старого Сургута</a>
</div>

