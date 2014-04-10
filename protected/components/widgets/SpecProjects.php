<?php
Yii::import('zii.widgets.CPortlet');

class SpecProjects extends CPortlet {

    protected function renderContent() {
//        $model = Yii::app()->cache->get('blogsRight');
//        if ($model === false) {
            $model = Article::model()->specProjects()->findAll();
//            Yii::app()->cache->set('blogsRight', $model, Config::getCacheduration());
//        }
        $this->render('specProjects', array('model' => $model));
    }

}
?>
