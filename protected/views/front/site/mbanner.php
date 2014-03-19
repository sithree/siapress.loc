<?php

Yii::import('zii.widgets.CPortlet');

class MBanner extends CPortlet {

    protected $items;
    public $position;

    public function __construct($owner = null) {
        parent::__construct($owner);
#$this->items = Banner::model()->find('`position` = ' . $this->position . ' AND published = 1 AND `start` > "' . date('Y-m-s h:i:s') .'" and `end` < "' . date('Y-m-s h:i:s') .'"');;
    }

    protected function renderContent() {
        if (Yii::app()->params['showBanner']) {
            if (isset($_GET['show_banner_position'])) {
                $this->render('mbanner', array('pos' => $this->position));
            } else {
                if ($this->position === 4 or $this->position ===8  or $this->position ===6  or $this->position ===2   or $this->position ===3 or $this->position ===1) {
                    $items = Banner::model()->findAll('`position` = ' . $this->position . ' AND `published` = 1 AND (`end` >=NOW() or ISNULL(`end`))');
                    $count = count($items);
                    if ($count > 1) {
                        $rand = rand(1, $count);
                        $id = array();
                        foreach ($items as $item) {
                            $id[] = $item->id;
                        }

                        $this->items = Banner::model()->findAll('`id` = ' . $id[$rand - 1] . ' and `position` = ' . $this->position . ' AND `published` = 1 AND `end` >=NOW()');
                        #print_r($this->items);
                    } else {
                        $this->items = Banner::model()->findAll('`position` = ' . $this->position . ' AND published = 1 AND `start` < "' . date('Y-m-d H:i:s') . '" and
            (`end` > "' . date('Y-m-d H:i:s') . '" or `end` = "0000-00-00 00:00:00") ORDER BY id desc');
                        ;
                    }
                } else {
                    $this->items = Banner::model()->findAll('`position` = ' . $this->position . ' AND published = 1 AND `start` < "' . date('Y-m-d H:i:s') . '" and
            (`end` > "' . date('Y-m-d H:i:s') . '" or `end` = "0000-00-00 00:00:00") ORDER BY id desc');
                    ;

                }
                $this->render('mbanner', array('items' => $this->items));
            }
        } else
            return;
    }

}

?>
