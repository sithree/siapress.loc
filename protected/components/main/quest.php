<?php

Yii::import('zii.widgets.CPortlet');

class Quest extends CPortlet {
    protected $items;

    public function __construct($owner = null) {
        parent::__construct($owner);
        #Yii::app()->cache->flush();
        $this->items = $loadmodel = Yii::app()->cache->get('quest');
        if($this->items == false){
            $this->items = Article::model()->findAll(array('with' => 'comments', 'condition'=>'cat_id = 16 and t.published = 1 and t.publish <= NOW() and `query` = 1','order'=>'t.publish DESC','limit' => 10));
            #print_r($this->items);
            Yii::app()->cache->set('quest', $this->items, Config::getCacheduration());
        }
    }

    protected function renderContent() {
        foreach ($this->items as $item){
            $this->render('quest',array('item' => $item));
        }
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }
}

?>
