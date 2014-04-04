<?php
Yii::import('zii.widgets.CPortlet');

class Blogs_1 extends CPortlet {

    protected function renderContent() {
//        $model = Yii::app()->cache->get('blogsRight');
//        if ($model === false) {
            $model = Article::model()->blogsRight()->findAll(array("limit" => 16));
//            Yii::app()->cache->set('blogsRight', $model, Config::getCacheduration());
//        }
        $this->render('blogs_1', array('model' => $model));
    }

}
?>
