<?php
Yii::import('zii.widgets.CPortlet');

class OldSurgut extends CPortlet {

    protected function renderContent() {
//        $model = Yii::app()->cache->get('blogsRight');
//        if ($model === false) {
            $model = Article::model()->oldSurgut()->findAll();
//            Yii::app()->cache->set('blogsRight', $model, Config::getCacheduration());
//        }
        $this->render('oldSurgut', array('model' => $model));
    }

}
?>
