<div class="widget no-padding" id="opinion">
    <div class="header">
        <h2><a href="#">Мнения</a></h2>
    </div>

    <?php
    if ($model) {
        foreach ($model as $item) {
            Yii::app()->controller->renderPartial('application.components.widgets.views._blogs_form_1', array('model' => $item, 'i' => $i++));
        }
    }
    ?>

    <a class="gray-light-button" href="/news/opinion">

        Больше мнений</a>
</div>
