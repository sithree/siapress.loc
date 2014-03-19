<?php

$this->widget('bootstrap.widgets.TbNavbar', array(
    'type' => '', // null or 'inverse'
    'brand' => 'СИА-ПРЕСС',
    'brandUrl' => '#',
    'collapse' => true, // requires bootstrap-responsive.css
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => array(
                array('label' => 'Главная', 'url' => array('article/index')),
                array('label' => 'Новая запись', 'url' => array('article/new')),
            ),
        ),
        '<ul class="pull-right nav" id="yw4">
                <li><a target="_blank" href="http://www.siapress.ru">На сайт</a></li>
                <li class="divider-vertical"></li><li><a href="/admin.php?r=site/logout">Выход (' . Yii::app()->user->name. ')</a></li>
                </ul>',
    ),
));
?>