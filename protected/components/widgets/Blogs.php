<?php
Yii::import('zii.widgets.CPortlet');

class Blogs extends CPortlet {

    protected function renderContent() {
        $model = Yii::app()->cache->get('blogsRight');
        if ($model === false) {
            $model = Article::model()->blogsRight()->findAll();
            Yii::app()->cache->set('blogsRight', $model, Config::getCacheduration());
        }
        $this->render('blogs', array('model' => $model));
    }

}
?>
