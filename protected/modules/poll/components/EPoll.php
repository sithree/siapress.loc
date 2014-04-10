<?php

Yii::import('zii.widgets.CPortlet');

class EPoll extends CPortlet {

    public $poll_id = 0;
    /**
     * Renders the portlet content.
     */
    public function renderContent() {
        Yii::app()->runController('poll/poll/actual/id/'.$poll_id);
        return;
    }
}
