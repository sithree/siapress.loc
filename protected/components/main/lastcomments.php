<?php

Yii::import('zii.widgets.CPortlet');

class Lastcomments extends CPortlet {
    protected $items;

    public function __construct($owner = null) {
        parent::__construct($owner);
        $cat = array('1,2,3,4,5,6,7,8,9,10,11,12,13,14');
        $this->items = Comment::model()->getLastcomments($cat, 0, 8);
    }

    protected function renderContent() {
        $this->render('lastcomments',array('items' => $this->items));
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

}

?>
