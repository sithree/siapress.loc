<?php

Yii::import('zii.widgets.CPortlet');

class Themes extends CPortlet {

    protected function renderContent() {
        $model = Theme::model()->findAll(
                array(
                    'limit' => 5,
                    'order' => 'last_update DESC, count desc'
        ));
        $this->render('themes', array('model' => $model));
    }

}

?>
