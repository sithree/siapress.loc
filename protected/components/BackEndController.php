<?php

class BackEndController extends BaseController {

    // лейаут
    public $layout = '//layouts/main';
    // меню
    public $menu = array();
    // крошки
    public $breadcrumbs = array();

    /*
      Фильтры
     */

    public function filters() {
        return array(
            'accessControl',
            array(
                'CHttpCacheFilter',
                'lastModified' => date('c'),
                'cacheControl' => 'no-store, no-cache, must-revalidate',
            ),
        );
    }

    /*
      Права доступа
     */

    public function accessRules() {
        return array(
            // даем доступ только админам
            array(
                'allow',
                #'users'=>array('admin'),
                'roles' => array('administrator', 'moderator', 'official','author','author_sia'),
            ),
            // всем остальным разрешаем посмотреть только на страницу авторизации
            array(
                'allow',
                'actions' => array('login'),
                'users' => array('?'),
            ),
            // запрещаем все остальное
            array(
                'deny',
                'message' => 'У вас нет прав для просмотра этой страницы.',
                'users' => array('*'),
            ),
        );
    }


}

?>
