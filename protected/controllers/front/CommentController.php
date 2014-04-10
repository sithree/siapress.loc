<?php

class CommentController extends Controller {

    public $layout = '//layouts/news/article';
    public $metaProperty;

    public function addMetaProperty($name, $content) {
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty() {
        return $this->metaProperty;
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionModerator() {
        $id = Yii::app()->request->getQuery('id');
        $action = Yii::app()->request->getQuery('action');
        $token = Yii::app()->request->getQuery('token');

        if (!isset($id) OR !isset($action) OR !isset($token))
            throw new CHttpException(404, '11 Invalid request. Please do not repeat this request again.');

        $comment = Comment::model()->find("id = {$id} AND `token` = '{$token}'");
        if ($comment) {
            $link = null;
            if ($comment->object_type_id == 2)
                $link = $this->createAbsoluteUrl('polls/view').'?id='.$comment->poll->id. '#comment-' . $id;
            else
                $link = $this->redirect($comment->article->link() . '#comment-' . $id);
            switch ($action) {
                case "rules":
                    $comment->published = 1;
                    $comment->ban = 1;
                    $comment->save();
                    Yii::app()->cache->flush();
                    $comments = Comment::model()->findAll('id = ' . $comment->id);
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('/comments/comments', array(
                            'comments' => $comments,
                        ));
                        Yii::app()->end();
                    }
                    $this->redirect($link);

                    break;
                case "author":
                    $comment->published = 1;
                    $comment->ban = 2;
                    $comment->save();

                    Yii::app()->cache->flush();
                    $comments = Comment::model()->findByPk($comment->id);
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('/comments/_comments_ajax', array(
                            'comments' => $comments,
                        ));
                        Yii::app()->end();
                    }

                    $this->redirect($link);

                    break;
                case "theme":
                    $comment->published = 1;
                    $comment->ban = 3;
                    $comment->save();

                    Yii::app()->cache->flush();
                    $comments = Comment::model()->findAll('id = ' . $comment->id);
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('/comments/comments', array(
                            'comments' => $comments,
                        ));
                        Yii::app()->end();
                    }

                    $this->redirect($link);

                    break;
                case "delete":
                    $comment->published = 0;
                    $comment->ban = 0;
                    $comment->save();
                    Yii::app()->cache->flush();
                    $comments = Comment::model()->findAll('id = ' . $comment->id);
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('/comments/comments', array(
                            'comments' => $comments,
                        ));
                        Yii::app()->end();
                    }
                    $this->redirect($link);

                    break;
                case "publish":
                    $comment->published = 1;
                    $comment->ban = 0;
                    $comment->save();

                    Yii::app()->cache->flush();
                    $comments = Comment::model()->findAll('id = ' . $comment->id);
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('/comments/comments', array(
                            'comments' => $comments,
                        ));
                        Yii::app()->end();
                    }
                    $this->redirect($link);

                    break;
                default:
                    throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
                    break;
            }
        }
        else
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
    }

}