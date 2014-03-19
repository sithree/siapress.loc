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
            'name' => 'publish',
            'value' => 'Helper::getFormattedtime($data->publish)',
            'headerHtmlOptions' => array(
                'style' => 'width:140px;'
            ),
            'filter' => false,
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl' => 'Yii::app()->createUrl("/article/view", array("id" => $data["id"]))',
            'deleteButtonOptions' => array('style' => 'display:none'),
            'updateButtonUrl' => 'Yii::app()->createUrl("/article/edit", array("id" =>  $data["id"]))',
            'headerHtmlOptions' => array(
                'style' => 'width:50px;'
            ),
        ),
    ),
));
?>
