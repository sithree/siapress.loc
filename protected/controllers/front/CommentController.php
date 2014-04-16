<?php

class CommentController extends Controller
{

    public $layout = '//layouts/news/article';
    public $metaProperty;

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'MCaptcha',
                'maxLength' => 4,
                'minLength' => 4,
                'transparent' => true,
                'testLimit' => 0,
            ),
                #'captchaAdction' => 'site/index'
        );
    }

    public function addMetaProperty($name, $content)
    {
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty()
    {
        return $this->metaProperty;
    }

    protected function getComment($id, $token)
    {
        $comment = Comment::model()->find("id = {$id} AND `token` = '{$token}'");
        if (!$comment)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        return $comment;
    }

    protected function sendResult($id)
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $comments = Comment::model()->findAll('id = ' . $comment->id);
            $this->renderPartial('/comments/comments', array(
                'comments' => $comments,
            ));
            Yii::app()->end();
        }
        $this->redirect($_SERVER['HTTP_REFERER'] . '#comment-' . $id);
    }

    protected function changeComment($id, $token, $params)
    {
        $comment = $this->getComment($id, $token);
        $comment->setAttributes($params, false);
        $comment->save();
        //Yii::app()->cache->flush();
        $this->sendResult($id);
    }

    public function actionMakeTheBest($id, $token, $value)
    {
        $params = array('best' => $value);
        if ($value > 0)
            $params['ban'] = 0;
        $this->changeComment($id, $token, $params);
    }

    public function actionMarkBan($id, $token, $value)
    {
        $params = array('ban' => $value);
        if ($value > 0)
            $params['best'] = 0;
        $this->changeComment($id, $token, $params);
    }

    public function actionMarkPublished($id, $token, $value)
    {
        $this->changeComment($id, $token, array(
            'published' => $value
        ));
    }

    public function actionBan($id, $token)
    {
        $comment = $this->getComment($id, $token);
        $this->sendResult($id);
    }

    public function actionAdd()
    {
        $comment = new CommentForm();
        if (isset($_POST['CommentForm']))
        {
            $comment->attributes = $_POST['CommentForm'];
            Yii::app()->request->cookies['pcomment_username'] = new CHttpCookie('pcomment_username', $comment->username);
            $ct = new CHttpCookie($id . '_pcomment_text', $comment->text);
            $ct->expire = time() + 60 * 60 * 24 * 7;
            Yii::app()->request->cookies[$id . '_pcomment_text'] = $ct;

            $error = false;
            if ($comment->validate())
            {
                //Записываем имя в куки
                $cookie = new CHttpCookie('pcomment_author', $comment->username);
                $cookie->expire = time() + 60 * 60 * 24 * 5;
                Yii::app()->request->cookies['pcomment_author'] = $cookie;



                /* Добавляем комментарий */
                $comm = new Comment;
                $comm->attributes = $_POST['CommentForm'];
                $comm->author_id = $comment->author_id;
                $comm->name = $comment->username;
                $comm->email = $comment->email;
                $comm->ip = $_SERVER['REMOTE_ADDR'];
                $comm->created = date('Y-m-d H:i:s');
                $comm->published = Yii::app()->params->autopublishcomment;
                $comm->parent = ($comment->parent) ? $comment->parent : 0;
                $comm->save();
                if ($comm->id > 0)
                {
                    $comment->text = '';
                    $comment->parent = '';
                    $comment->capcha = '';
                    unset(Yii::app()->request->cookies[$id . '_pcomment_text']);
                    $commadd = new CommentAdd;
                    $commadd->comment_id = $comm->id;
                    $commadd->save();
                } else
                {
                    $error = false;
                }
            } else
            {
                $error = false;
            }

            $comments = null;
            if (Yii::app()->user->checkAccess('administrator'))
            {
                $comments = Comment::model()->with('commentAdd')->findAll(array('condition' => 'object_id = ' . $comment->object_id . ' AND object_type_id = ' . $comment->object_type_id . ' AND t.id > ' . $_POST['lastCommentId']));
            } else
            {
                $comments = Comment::model()->published()->with('commentAdd')->findAll(array('condition' => 'object_id = ' . $comment->object_id . ' AND object_type_id = ' . $comment->object_type_id . ' AND t.id > ' . $_POST['lastCommentId']));
            }
            echo json_encode(array(
                'error' => $error,
                'comments' => $this->renderPartial('application.views.front.comments.comments', array('comments' => $comments, 'url' => $_SERVER['HTTP_REFERER'], 'new' => true), true),
                'form' => $this->renderPartial('application.views.front.comments._form', array('commentform' => $comment, 'object_id' => $comment->object_id, 'object_type_id' => $comment->object_type_id, 'new' => true), true)
            ));
        }
        Yii::app()->end();
    }

    public function actionLoadLast()
    {
        if (!Yii::app()->request->isAjaxRequest)
            return;
        $comment = new Comment();
        $comment->attributes = $_POST['CommentForm'];
        $comments = null;
        if (Yii::app()->user->checkAccess('administrator'))
        {
            $comments = Comment::model()->with('commentAdd')->findAll(array('condition' => 'object_id = ' . $comment->object_id . ' AND object_type_id = ' . $comment->object_type_id . ' AND t.id > ' . $_POST['lastCommentId']));
        } else
        {
            $comments = Comment::model()->published()->with('commentAdd')->findAll(array('condition' => 'object_id = ' . $comment->object_id . ' AND object_type_id = ' . $comment->object_type_id . ' AND t.id > ' . $_POST['lastCommentId']));
        }
        $this->renderPartial('application.views.front.comments.comments', array('comments' => $comments, 'new' => true, 'url' => $_SERVER['HTTP_REFERER']));
    }

    public function actionGetComment($objectTypeId, $id, $lastCommentId)
    {
        $object = $objectTypeId == 1 ? Article::model()->findByPk($id) : Poll::model()->findByPk($id);
        $object->comments();
    }

}
