<div class="widget no-padding" id="opinion">
    <div class="header">
        <h2><a href="<?php echo Yii::app()->createUrl('/opinions'); ?>">Мнения</a></h2>
    </div>

    <?php
    if ($model) {
        foreach ($model as $item) {
            Yii::app()->controller->renderPartial('application.components.widgets.views._blogs_form_1', array('model' => $item, 'i' => $i++));
        }
    }
    ?>
    <div id="loadOpinions"></div>
    
    <a id="moreOpinions" class="gray-light-button" href="/opinions">Больше мнений</a>
    
</div>
