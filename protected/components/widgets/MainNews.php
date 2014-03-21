<?php

Yii::import('zii.widgets.CPortlet');

class Mainnews extends CPortlet {
    #public $title = 'Blogs';

    public $limit = 5;
    protected $main;
    protected $politics = array();

    public function __construct($owner = null) {
        parent::__construct($owner);
        $category = array('1,2,3,4,5,6,7,10,11,13,15,19,20,21,22');
        $category2 = array('1,2,3,4,5,6,7,10,11,13,15,19,20,22');
        $this->main = Article::model()->getMainitem($category, false);
        $this->politics = Article::model()->getItems($category2, 14);
    }

    protected function renderContent() {
        $this->render('application.views.front.ajax.main', array('main' => $this->main, 'politics' => $this->politics));
    }

    public function getBlogs() {
        #Yii::app()->cache->flush();
        $blogs = Yii::app()->cache->get('blogs');
        if ($blogs === false) {
            $rows = Yii::app()->db->createCommand('SELECT a.*, u.name as username, c.name as catname FROM sia_articles as a
            LEFT JOIN sia_article_categories as c on a.cat_id = c.id
            left join sia_users as u on a.author = u.id
            WHERE a.cat_id IN (8)
            AND a.publish <= "' . date('Y-m-s H:i:s') . '"
            AND a.published = 1
            order by a.publish desc
            limit 6')->queryAll();

            Yii::app()->cache->set('blogs', $rows, Config::getCacheduration());
            $blogs = $rows; #Yii::app()->cache->get('blogs');
            return $rows;
        }

        return $blogs;

        return Article::model()->with('author0', 'category')->findAll(array(
                    'limit' => $this->limit,
                    'order' => 'created DESC',
                    'condition' => 'type_id = 1',
                ));
    }

}

?>
