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
    
    public function actionAdd() {
        $comment = new CommentForm();
        if (isset($_POST['CommentForm'])) {
            $comment->attributes = $_POST['CommentForm'];
            CVarDumper::dump($comment->attributes);
            die();
            Yii::app()->request->cookies['pcomment_username'] = new CHttpCookie('pcomment_username', $comment->username);
            $ct = new CHttpCookie($id . '_pcomment_text', $comment->text);
            $ct->expire = time() + 60 * 60 * 24 * 7;
            Yii::app()->request->cookies[$id . '_pcomment_text'] = $ct;

            if ($comment->validate()) {
                //Записываем имя в куки
                $cookie = new CHttpCookie('pcomment_author', $comment->username);
                $cookie->expire = time() + 60 * 60 * 24 * 5;
                Yii::app()->request->cookies['pcomment_author'] = $cookie;



                /* Добавляем комментарий */
                $comm = new Comment;
                $comm->text = $comment->text;
                $comm->author_id = $comment->author_id;
                $comm->name = $comment->username;
                $comm->email = $comment->email;
                $comm->ip = $_SERVER['REMOTE_ADDR'];
                $comm->created = date('Y-m-d H:i:s');
                $comm->published = Yii::app()->params->autopublishcomment;
                $comm->parent = ($comment->parent) ? $comment->parent : 0;
                $comm->save();
                if ($comm->id > 0) {
                    unset(Yii::app()->request->cookies[$id . '_pcomment_text']);

                    $commadd = new CommentAdd;
                    $commadd->comment_id = $comm->id;
                    $commadd->save();
                    Yii::app()->user->setFlash('info', 'Комментарий успешно добавлен.');

                    $comment->text = '';
                    $comment->capcha = '';

                    Yii::app()->cache->flush();

                    $this->refresh(true, '#' . $comm->id);
                } else
                    $this->refresh(true, '#addcomment');
                Yii::app()->user->setFlash('error', 'Ошибка добавления комментария. ');
            } else
                Yii::app()->user->setFlash('error', 'Ошибка добавления комментария. ');
            $this->refresh(true, '#addcomment');
        }
        Yii::app()->end();
    }
    
    public function actionGetComment($objectTypeId, $id, $lastCommentId) {
        $object = $objectTypeId == 1 ? Article::model()->findByPk($id) : Poll::model()->findByPk($id);
        $object->comments();
    }

}