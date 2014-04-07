<?php ?>
<?php

Yii::import('zii.widgets.CPortlet');

class MainNews extends CPortlet {
    #public $title = 'Blogs';

    protected function renderContent() {

        $categories = Article::getMainNewsCategories();
        $criteria = new CDbCriteria;

        $criteria->addCondition('t.cat_id IN(' . $categories . ')');
        $criteria->limit = 13;
        $criteria->select = 'id, title,author_alias, author, cat_id, publish';
        $criteria->order = 't.publish DESC';
        $criteria->with = array('articleAdd', 'comments');

        $criteria->addCondition('`t`.`publish` <= "' . date('Y-m-d H:i:s') . '" ');
//        $criteria->addCondition('`t`.`publish` !=> "' . date('Y-m-s H:i:s') . '" ');

        $criteria->addCondition('`t`.`published` = 1');
        $criteria->addCondition('`t`.`id` != ' . Yii::app()->db->createCommand("SELECT id from {{articles}} where main = 1 and published = 1 and publish <= '" . new CDbExpression("NOW()") . "' order by id desc limit 1")->queryScalar());

        $model = Article::model()->findAll($criteria);

        $this->render('application.views.front.ajax.main', array('model' => $model));
    }

}

?>
