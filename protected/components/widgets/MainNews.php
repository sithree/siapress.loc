<?php

Yii::import('zii.widgets.CPortlet');

class Mainnews extends CPortlet {
    #public $title = 'Blogs';

    protected function renderContent() {
        $categories = array('1,2,3,4,5,6,7,10,11,13,15,19,20,21,22');

        $criteria = new CDbCriteria;
        $criteria->addInCondition('cat_id', $categories);
        $criteria->limit = 14;
        $criteria->with = array('category', 'author0', 'articleAdd','comments');
        $criteria->order = 't.publish DESC';
//      $criteria->addCondition('`t`.`publish` >=', date('Y-m-s H:i:s'));
//      $criteria->addCondition('`t`.`published` =', 1);
        $model = Article::model()->findAll($criteria);
        $this->render('application.views.front.ajax.main', array('model' => $model));
    }
}

?>
