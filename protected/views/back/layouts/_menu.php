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
                array('label' => 'Новый материал', 'url' => array('article/new')),
                '---',
                array('label' => 'Пользователи', 'url' => array('users/admin'), 'items' => array(
                        array('label' => 'Создать', 'url' => array('users/create')),
                        '---',
                        array('label' => 'Все пользователи', 'url' => array('users/admin')),
                )),
                
//                        array('label' => 'Комментарии', 'url' => '#', 'items' => array(
//                                array('label' => 'Создать', 'url' => '#'),
//                                '---',
//                                array('label' => 'Все материалы', 'url' => '#'),
//                        )),
//                        array('label' => 'Опросы', 'url' => '#', 'items' => array(
//                                array('label' => 'Создать', 'url' => '#'),
//                                '---',
//                                array('label' => 'Все материалы', 'url' => '#'),
//                        )),
            ),
        ),
//                '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',

        '<ul class="pull-right nav" id="yw4">
                <li><a target="_blank" href="http://www.siapress.ru">На сайт</a></li>
                <li> ' . CHtml::ajaxLink('Очистить кеш', array('ajax/cacheClean'), array('success' => 'alert("Кеш успешно очищен")')) . '</li>
                <li class="divider-vertical"></li><li><a href="/admin.php?r=site/logout">Выход (admin)</a></li>
                </ul>',
    ),
));
?>