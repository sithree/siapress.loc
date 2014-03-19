<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'article-grid',
    'dataProvider' => $model->search(array('author' => 100)),
    'filter' => $model,
    'type' => 'bordered',
    'columns' => array(
        array(
            'name' => 'id',
            'htmlOptions' => array('style' => 'text-align: center; width:40px;'),
            #'filter' => false,
            'headerHtmlOptions' => array(
                'style' => 'width:40px;'
            ),
            'filterHtmlOptions' => array(
                'style' => 'width:40px;'
            ),
        ),
        'title',
        array(
            'name' => 'cat_id',
            'value' => '$data->category->name',
            'filter' => CHtml::listData(ArticleCategories::model()->list()->findAll(), 'id', 'name'),
            'headerHtmlOptions' => array(
                'style' => 'width:80px;'
            ),
            'filterHtmlOptions' => array(
                'style' => 'width:80px;'
            ),
        ),
        array(
            'name' => 'author',
            'value' => '$data->author_alias ? Helper::trimText($data->author_alias,25) : $data->author0->name',
            'filter' => CHtml::listData(Users::model()->author()->findAll(), 'id', 'name'),
            'headerHtmlOptions' => array(
                'style' => 'width:120px;'
            ),
        ),
        array(
            'name' => 'publish',
            'value' => 'Helper::getFormattedtime($data->publish)',
            'headerHtmlOptions' => array(
                'style' => 'width:140px;'
            ),
            'filter' => false,
        ),
        array(
            'name' => 'main',
            'value' => '$data->main ? "<i class=\"icon-star\"></i>" : ""',
            'filter' => array(1 => 'Главная'),
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align: center; width:20px;'),
        ),
        array(
            'name' => 'top',
            'value' => '$data->top ? "<i class=\"icon-user\"></i>" : ""',
            'filter' => array(1 => 'Вверху'),
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align: center; width:20px;'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl' => 'Yii::app()->createUrl("/article/view", array("id" => $data["id"]))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("/article/delete", array("id" =>  $data["id"]))',
            'updateButtonUrl' => 'Yii::app()->createUrl("/article/edit", array("id" =>  $data["id"]))',
            'headerHtmlOptions' => array(
                'style' => 'width:50px;'
            ),
        ),
    ),
));
?>