<?php
Yii::import('zii.widgets.CPortlet');

class OnlineProjects extends CPortlet {

    protected function renderContent() {
//        $model = Yii::app()->cache->get('blogsRight');
//        if ($model === false) {
            $model = Article::model()->onlineProjects()->findAll();
//            Yii::app()->cache->set('blogsRight', $model, Config::getCacheduration());
//        }
        $this->render('onlineProjects', array('model' => $model));
    }

}
?>
