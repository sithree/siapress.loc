<?php

Yii::import('zii.widgets.CPortlet');

class Official extends CPortlet {
    protected $items;

    public function __construct($owner = null) {
        parent::__construct($owner);
        
        $categories = Article::getOfficialCategories();
       
       
        if (Yii::app()->cache->get('Officials') === false){
            Yii::app()->cache->set('Officials', Yii::app()->db->createCommand("SELECT MAX(modified) from {{articles}} where cat_id IN(" . $categories . ") and published = 1")->queryScalar(),
            Yii::app()->params['cacheExpireLong']);
//             die("<p>$categories</p>");
        }
        
        $this->items = Article::model()->getItems('official',9);
        #print_r($this->items);
       # die();
    }

    protected function renderContent() {
        $this->render('official',array('items' => $this->items));
        #$this->render('application.views.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

}

?>
