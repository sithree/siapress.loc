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
            $comments = Comment::model()->findAll('id = ' . $id);
            $this->renderPartial('/comments/comments', array(
                'comments' => $comments,
            ));
            Yii::app()->end();
        }
        $link = Yii::app()->request->urlReferrer;
        if (!$link)
        {
            $comment = Comment::model()->findByPk($id);
            $link = $comment->article->link(true);
        }
        $this->redirect($link . '#comment-' . $id);
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
        $date = new DateTime();
        User::ban($date->add(new DateInterval('P1D'))->format('Y-m-d H:i:s'), $comment->ip);
        $this->sendResult($id);
    }

    public function actionWhine($id)
    {
        $comment = CommentAdd::model()->findByPk($id);
        if (!$comment)
        {
            $comment = new CommentAdd();
            $comment->$id = $id;
        }
        if ($comment->whines >= 5)
        {
            $c = Comment::model()->findByPk($id);
            if ($c)
            {
                $c->ban = 4;
                $c->save();
            }
        }
        {
            $comment->whines++;
            $comment->save();
            $cookie = new CHttpCookie('comment_whine_' . $comment->comment_id, '1');
            $cookie->expire = time() + 86400;
            Yii::app()->request->cookies['comment_whine_' . $comment->comment_id] = $cookie;
        }
        $this->sendResult($id);
    }

    public function actionSetParent($objectTypeId, $objectId, $parent)
    {
        $pcName = $objectTypeId . '_' . $objectId . '_comment_parent';
        Yii::app()->request->cookies[$pcName] = new CHttpCookie($pcName, $parent);
        $this->redirect(Yii::app()->request->urlReferrer . '#addcomment');
    }

    public function actionRemoveParent($objectTypeId, $objectId)
    {
        unset(Yii::app()->request->cookies[$objectTypeId . '_' . $objectId . '_comment_parent']);
        $this->redirect(Yii::app()->request->urlReferrer . '#addcomment');
    }

    public function actionLike($id)
    {
        if (isset(Yii::app()->request->cookies['comment_' . $comment->comment_id]))
            return;
        $comment = CommentAdd::model()->findByPk($id);
        $comment->like++;
        $comment->save();

        $cookie = new CHttpCookie('comment_' . $comment->comment_id, '1');
        $cookie->expire = time() + 86400;
        Yii::app()->request->cookies['comment_' . $comment->comment_id] = $cookie;
        $this->sendResult($id);
    }

    public function actionDislike($id)
    {
        if (isset(Yii::app()->request->cookies['comment_' . $comment->comment_id]))
            return;
        $comment = CommentAdd::model()->findByPk($id);
        $comment->dislike++;
        $comment->save();

        $cookie = new CHttpCookie('comment_' . $comment->comment_id, '1');
        $cookie->expire = time() + 86400;
        Yii::app()->request->cookies['comment_' . $comment->comment_id] = $cookie;
        $this->sendResult($id);
    }

    protected function canAdd($comment)
    {
        $date = new DateTime();
        $ip = Yii::app()->request->userHostAddress;
        $lastComment = Comment::model()->find(array('condition' => "ip='{$ip}'", 'order' => 'id DESC', 'limit' => 1));

        if (User::isBaned())
            return 'Комментарии для вас заблокированы';

        if ($lastComment && time() - strtotime($lastComment->created) < 15)
            return 'Слишком частое комментирование';

        $lastComment = Comment::model()->findAll("created > '{$date->format('Y-m-d')}' AND ip='{$ip}' AND text='$comment->text'");

        foreach ($lastComment as $c)
            if (!$c->published || $c->ban)
            {
                User::ban($date->add(new DateInterval('P1D'))->format('Y-m-d H:i:s'));
                return 'Ваш ip адрес заблокирован. У вас нет возможности оставлять комментарий.';
            }
        if ((bool) count($lastComment))
            return 'Такой комментарий вы уже оставляли.';
        return '';
    }

    public function actionAdd()
    {
        $comment = new Comment();
        if (isset($_POST['Comment']))
        {
            $comment->attributes = $_POST['Comment'];
            $message = $this->canAdd($comment);

            if (!$message)
            {
                $prefix = $comment->object_type_id . '_' . $comment->object_id . '_';
                Yii::app()->request->cookies['comment_username'] = new CHttpCookie('comment_username', $comment->name);
                Yii::app()->request->cookies[$prefix . 'comment_text'] = new CHttpCookie($prefix . 'comment_text', $comment->text);
                Yii::app()->request->cookies[$prefix . 'comment_parent'] = new CHttpCookie($prefix . 'comment_parent', $comment->parent);
                $comment->ip = Yii::app()->request->userHostAddress;
                $comment->published = Yii::app()->params->autopublishcomment;
                $comment->created = date('Y-m-d H:i:s');

                $comment->save();
                if ($comment->id > 0)
                {
                    unset(Yii::app()->request->cookies[$prefix . 'comment_text']);
                    unset(Yii::app()->request->cookies[$prefix . 'comment_parent']);
                    unset(Yii::app()->request->cookies[$prefix . 'comment_validate']);
                    $commadd = new CommentAdd;
                    $commadd->comment_id = $comment->id;
                    $commadd->save();
                    if (!Yii::app()->request->isAjaxRequest)
                        $this->redirect(Yii::app()->request->urlReferrer . '#comment-' . $comment->id);
                    $comment = new Comment();
                    $comment->attributes = $_POST['Comment'];
                    $comment->text = '';
                    $comment->parent = '';
                    $comment->capcha = '';
                } else
                {
                    Yii::app()->request->cookies[$prefix . 'comment_validate'] = new CHttpCookie($prefix . 'comment_validate', 1);
                    if (!Yii::app()->request->isAjaxRequest)
                        $this->redirect(Yii::app()->request->urlReferrer . '#addcomment');
                }
            }else
            {
                $comment->capcha = '';
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
                'comments' => $this->renderPartial('application.views.front.comments.comments', array('comments' => $comments, 'new' => true), true),
                'form' => $this->renderPartial('application.views.front.comments._form', array('comment' => $comment, 'message' => $message), true)
            ));
        }
        Yii::app()->end();
    }

    public function actionLoadLast()
    {
        if (!Yii::app()->request->isAjaxRequest)
            return;
        $comment = new Comment();
        $comment->attributes = $_POST['Comment'];
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
