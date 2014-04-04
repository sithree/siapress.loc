<?php

class AjaxController extends CController {

    // actionIndex вызывается всегда, когда action не указан явно.
    function actionIndex() {

        $input = $_POST['input'];
        // для примера будем приводить строку к верхнему регистру
        $output = mb_strtoupper($input, 'utf-8');

        // если запрос асинхронный, то нам нужно отдать только данные
        if (Yii::app()->request->isAjaxRequest) {
            echo CHtml::encode($output);
            // Завершаем приложение
            Yii::app()->end();
        } else {
            // если запрос не асинхронный, отдаём форму полностью
            $this->render('form', array(
                'input' => $input,
                'output' => $output,
            ));
        }
    }

    function actionLogin() {
        #print_r($_POST);
        #Yii::app()->end();
        $login = $_POST['login'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];

        if (Yii::app()->request->isAjaxRequest) {
            if (empty($login) OR empty($password)) {
                echo 'Не все поля заполнены!';
                Yii::app()->end();
            } else {
                $ui = new UserIdentity;

                return true;
                // Завершаем приложение
                Yii::app()->end();
            }
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    function actionGetmainnews() {
        if (Yii::app()->request->isAjaxRequest) {
            #$category = $_POST['category'];
            $page = intval($_POST['page2']);
            #$main = Article::model()->getMainitem($category);
            $politics = Article::model()->getItems(Article::model()->getNewscat(), 10, $page);
            #echo "привет";
            $this->renderPartial('mainnews', array('politics' => $politics));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    function actionGetphotos() {
        if (Yii::app()->request->isAjaxRequest) {
            $category = 'photos';
            $page = intval($_POST['page']);

            $items = Article::model()->getItems($category, 12, $page);

            $this->renderPartial('application.views.photos._form', array('items' => $items));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    function actionGetopinions() {
        if (Yii::app()->request->isAjaxRequest) {
            $page = intval($_POST['page']);
            $limit = Article::model()->blogLimit;

            $model = Article::model()->blogsRight()->findAll(array('limit' => $limit, 'offset' => ($limit * $page) - $limit));

            #echo ("$start, $end");
            #die();
            foreach ($model as $item) {
                $this->renderPartial('application.components.views._blogs_form', array('model' => $item));
            }
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    
    

    function actionLikecomment() {
        if (Yii::app()->request->isAjaxRequest) {
            $id = $_POST['id'];
            //$sessid = $_REQUEST['PHPSESSID'];

            $comment = CommentAdd::model()->findByPk(intval($id));
//            if (!$comment) {
//                $comment = new CommentAdd;
//                $comment->comment_id = $id;
//                ($_POST['type'] == 'like') ? $comment->like++ : $comment->dislike++;
//                $comment->save();
//            } else {
            ($_POST['type'] == 'like') ? $comment->like = $comment->like + 1 : $comment->dislike++;
            $comment->save();
//            }
            #Yii::app()->cache->flush();

            $like = (int) $comment->like - (int) $comment->dislike;
            if ($like > 0) {
                $like = '+' . $like;
                $class = 'green';
            } elseif ($like < 0) {
                $class = 'red';
            }
            else
                $class = 'green';
            if ($comment->comment_id) {
                $cookie = new CHttpCookie('comment_' . $comment->comment_id, '1');
                $cookie->expire = time() + 86400;
                Yii::app()->request->cookies['comment_' . $comment->comment_id] = $cookie;

                //Добавляем в текущую сесиию, если у пользователя не принимает Куки
                $session = new CHttpSession;
                $session->open();
                $session['comment_' . $comment->comment_id] = 1;
               
            }

            echo "<span id='$id' class='like-result $class'>$like</span>";
            Yii::app()->end();
        }
    }
    
    function actionLikeArticle() {
        if (Yii::app()->request->isAjaxRequest) {
            $id = $_POST['id'];
            //$sessid = $_REQUEST['PHPSESSID'];

            $article = ArticleAdd::model()->find('article_id='.$id);
            if (!$article) {
                $article = new ArticleAdd();
                $article->article_id = $id;
            }
            ($_POST['type'] == 'like') ? $article->like++ : $article->dislike++;
            $article->save();

            $like = (int) $article->like - (int) $article->dislike;
            if ($like > 0) {
                $like = '+' . $like;
                $class = 'green';
            } elseif ($like < 0) {
                $class = 'red';
            }
            else
                $class = 'green';
            if ($article->article_id) {
                $cookie = new CHttpCookie('articlelike_' . $article->article_id, '1');
                $cookie->expire = time() + 86400;
                Yii::app()->request->cookies['articlelike_' . $article->article_id] = $cookie;

                //Добавляем в текущую сесиию, если у пользователя не принимает Куки
                $session = new CHttpSession;
                $session->open();
                $session['articlelike_' . $article->article_id] = 1;
               
            }

            echo $this->renderPartial('vote',array('model' => $article));
            Yii::app()->end();
        }
    }

}

?>
