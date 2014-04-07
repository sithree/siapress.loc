<?php

Yii::import('zii.widgets.CPortlet');

class Themes extends CPortlet {

    protected function renderContent() {
        $model = Theme::model()->findAll(
                array(
                    'limit' => 5,
        ));
        $this->render('themes', array('model' => $model));
    }

}

?>
