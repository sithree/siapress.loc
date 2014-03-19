<?php

Yii::import('zii.widgets.CPortlet');

class Official extends CPortlet {
    protected $items;

    public function __construct($owner = null) {
        parent::__construct($owner);
        $this->items = Article::model()->getItems('official',6);
        #print_r($this->items);
       # die();
    }

    protected function renderContent() {
        $this->render('official',array('items' => $this->items));
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

}

?>
