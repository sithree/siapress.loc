<?php

Yii::import('zii.widgets.CPortlet');

class Popular extends CPortlet {
    protected $items;
    protected $last;
    protected $pop;

    public function __construct($owner = null) {
        parent::__construct($owner);
        #Yii::app()->cache->flush();
        $this->items = Article::model()->getPopularitems(8);
        $cat = array('1,2,3,4,5,6,7,8,9,10,11,12,13,14');
        $this->last = Comment::model()->getLastcomments($cat, 0, 8);
        $this->pop = Comment::model()->getPopularcomments($cat, 0, 12);
        
      
    }

    protected function renderContent() {
        $this->render('popular',array('items' => $this->items, 'last' => $this->last, 'pop' => $this->pop));
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

}

?>
