<?php

Yii::import('zii.widgets.CPortlet');

class Bloggers extends CPortlet {
    protected $items;

    public function __construct($owner = null) {
        parent::__construct($owner);
        $this->items = $loadmodel = Yii::app()->cache->get('bloggers');
        if($this->items == false){
            $this->items = Article::model()->getBlogs(3);
            Yii::app()->cache->set('bloggers', $this->items, Config::getCacheduration());
        }
        #print_r($this->items);
       # die();
    }

    protected function renderContent() {
        $this->render('bloggers',array('items' => $this->items));
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

}

?>
