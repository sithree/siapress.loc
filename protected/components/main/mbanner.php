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
                $criteria = new CDbCriteria();
                $criteria->addCondition('`published` = 1');
                $criteria->addCondition('`position` = ' . $this->position);
                $criteria->addCondition('`start` <= "' . date('Y-m-d H:i:s') . '"');
                $criteria->addCondition('(`end` > "' . date('Y-m-d H:i:s') . '" or `end` = "0000-00-00 00:00:00")');
                $criteria->order = '`cat_id` DESC, `start` DESC';


                $this->items = Banner::model()->findAll($criteria);


               // echo(count($this->items) . ' po ' .$this->position);
                $group = array();

                foreach ($this->items  as $key => $item) {

                    if ($item->cat_id > 0) {
                        $cat = ArticleCategories::model()->find('alias = "' . Yii::app()->controller->actionParams['category'] . '"');
                        $cat_id = $cat->id;
                        //echo "<br /> id == " . $cat_id;
                        if($item->cat_id !== $cat_id){
                            //echo "<br /> Удаляем неверного " . $item->id . '  ' . $key;
                            unset($this->items[$key]);
                        }
                    } else

                    if ($item->group > 0) {
                        $group[$item->position][] = $item;
                    }
                }


                //Проходим архив на наличие совпадений по группам
                foreach ($group as $g) {
                    //Если количество в группе превышает 1, то удалеям лишнее
                    if (count($g) > 1) {
                        $count = count($g);
                        $rand = rand(1, $count) - 1;
                        foreach ($g as $d) {
                            if ($d->id != $g[$rand]->id) {
                                unset($this->items[$rand]);
                            }
                        }
                    }
                }

//                $count = count($items);
//                if ($count > 1) {
//                    $rand = rand(1, $count);
//                    $id = array();
//                    foreach ($items as $item) {
//                        $id[] = $item->id;
//                    }
//                    $criteria->addCondition('`id` = ' . $id[$rand - 1]);
//                    $this->items = Banner::model()->findAll($criteria);
//                    #print_r($this->items);
//                } else {
//                    $this->items = Banner::model()->findAll($criteria);
//                }
            }
            foreach ($this->items as $item) {
                $item->views++;
                #echo "---  " . $item->id;
                if (empty($item->key))
                    $item->key = md5($item->id);
                $item->save();
            }

            $this->render('mbanner', array('items' => $this->items));
        }
        else
            return;
    }

}
?>
