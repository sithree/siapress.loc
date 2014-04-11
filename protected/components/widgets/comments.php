<?php

Yii::import('zii.widgets.CPortlet');

class Comments extends CPortlet {

    public $object_type_id;
    public $object_id;
    public $comment_on = false;

    protected function renderContent() {
        $comment = new CommentForm();
        if (Yii::app()->user->checkAccess('administrator')) {
        $comments = Comment::model()->with('commentAdd')->findAll(array('condition' => 'object_id = ' . $this->object_id . ' AND object_type_id = '.$this->object_type_id));
        } else
        $comments = Comment::model()->published()->with('commentAdd')->findAll(array('condition' => 'object_id = ' . $this->object_id. ' AND object_type_id = '.$this->object_type_id));
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.scripts') . '/comments.js'
                ), CClientScript::POS_END
        );
        $this->render('comments', array('comments' => $comments, 'comment' => $comment));
    }
}
