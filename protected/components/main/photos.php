<?php

Yii::import('zii.widgets.CPortlet');

class Photos extends CPortlet {
    protected $items;

    public function __construct($owner = null) {
        parent::__construct($owner);

        $this->items = Article::model()->getItems('photos',6,0);
    }

    protected function renderContent() {
        $this->render('application.views.photos._form',array('items' => $this->items));
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

}

?>
