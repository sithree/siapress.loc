<?php

class ThemesController extends Controller {

//    public $layout = '//layouts/index';
    public $metaProperty;

    public function addMetaProperty($name, $content) {
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty() {
        return $this->metaProperty;
    }

    public function actionIndex($id) {
        $this->layout = '//layouts/news/article';

        $model = Theme::model()->findByPk($id);

        $this->render('index', array('model' => $model));
    }

    public function actionIndex3() {
        $this->layout = '//layouts/main';
        $this->render('index3');
    }

}
