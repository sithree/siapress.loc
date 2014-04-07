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

        $theme = Theme::model()->findByPk($id);

        $model = Article::model()->findAll(array(
            'limit' => 100,
            'order' => 'id DESC',
            'condition' =>
            'published  = 1 and ' .
            'publish <= ' . new CDbExpression('NOW()') . ' and ' .
            'theme = ' . $theme->id
        ));

        $this->render('index', array('theme' => $theme, 'model' => $model));
    }

    public function actionIndex3() {
        $this->layout = '//layouts/main';
        $this->render('index3');
    }

}
