<?php

Yii::import('zii.widgets.CPortlet');

class TrueMainnews extends CPortlet {
    #public $title = 'Blogs';

    protected function renderContent() {
        $categories = Article::getMainNewsCategories();


        $criteria = new CDbCriteria;
//        $criteria->addInCondition('cat_id', $categories);
        $criteria->limit = 1;
        $criteria->with = array('articleAdd', 'comments');
        $criteria->select = 'id, title,author_alias, author, cat_id, publish, modified, introtext';

        $criteria->order = 't.publish DESC';
        $criteria->addCondition('`t`.`publish` <= "' . date('Y-m-d H:i:s') . '" ');
        $criteria->addCondition('`t`.`main` = 1');
        $criteria->addCondition('`t`.`published` = 1');

        $model = Article::model()->find($criteria);
        $this->render('trueMainNews', array('item' => $model));
    }

}

?>
