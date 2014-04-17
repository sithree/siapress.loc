<?php

Yii::import('zii.widgets.CPortlet');

class Comments extends CPortlet {

    public $object_type_id;
    public $object_id;
    public $comment_on = false;

    protected function renderContent() {
        $params = array();
        $comment = new Comment();
        $comment->object_type_id = $this->object_type_id;
        $comment->object_id = $this->object_id;
        $parent = Yii::app()->request->getParam('parent');
        if (isset($parent)) {
            $comment->parent = $parent;
        }
        $comment->name = Yii::app()->request->cookies['comment_username']->value;
        $comments = Yii::app()->user->checkAccess('administrator') ? Comment::model() : Comment::model()->published();
        $comments = $comments->findAll(array('condition' => 'object_id = ' . $this->object_id . ' AND object_type_id = ' . $this->object_type_id));
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.scripts') . '/comments.js'
                ), CClientScript::POS_END
        );
        $params['replyUrl'] = explode('?', Yii::app()->request->url)[0];
        $params['comments'] = $comments;
        $params['comment'] = $comment;
        $this->render('comments', array('comments' => $comments, 'comment' => $comment, 'params' => $params));
    }

}
