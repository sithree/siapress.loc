<?php
Yii::import('zii.widgets.CPortlet');

class Photos extends CPortlet {

    protected function renderContent() {
//        $model = Yii::app()->cache->get('blogsRight');
//        if ($model === false) {
            $model = Article::model()->photos()->findAll();
//            Yii::app()->cache->set('blogsRight', $model, Config::getCacheduration());
//        }
        $this->render('photos', array('model' => $model));
    }

}
?>
