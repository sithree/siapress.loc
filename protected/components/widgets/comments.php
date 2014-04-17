<?php

Yii::import('zii.widgets.CPortlet');

class Comments extends CPortlet
{

    public $object_type_id;
    public $object_id;
    public $comment_on = false;

    protected function renderContent()
    {
        $comment = new Comment();
        $comment->object_type_id = $this->object_type_id;
        $comment->object_id = $this->object_id;
        $prefix = $this->object_type_id . '_' . $this->object_id . '_';
        $comment->name = Yii::app()->request->cookies['comment_username']->value;
        $comment->text = Yii::app()->request->cookies[$prefix . 'comment_text']->value;
        $comment->parent = Yii::app()->request->cookies[$prefix . 'comment_parent']->value;
        if (Yii::app()->request->cookies[$prefix . 'comment_validate'])
        {
            $comment->validate();
        }

        $comments = Yii::app()->user->checkAccess('administrator') ? Comment::model() : Comment::model()->published();
        $comments = $comments->findAll(array('condition' => 'object_id = ' . $this->object_id . ' AND object_type_id = ' . $this->object_type_id));
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.scripts') . '/comments.js'
                ), CClientScript::POS_END
        );
        $this->render('comments', array('comments' => $comments, 'comment' => $comment));
    }

}
