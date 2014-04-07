<?php

class ArticleController extends Controller {

    public $layout = '//layouts/news/article';
    public $metaProperty;

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'CHttpCacheFilter',
                'lastModified' => date('Y-m-d H:i:s'), // Yii::app()->db->createCommand("SELECT MAX(`publish`) FROM {{articles}} where `published` = 1 order by `publish` desc")->queryScalar(),
                'cacheControl' => 'no-store, no-cache, must-revalidate',
            ),
        );
    }

    public function addMetaProperty($name, $content) {
        $this->metaProperty .= "<meta property=\"" . CHtml::encode($name) . "\" content=\"" . CHtml::encode($content) . "\" />\r\n";
    }

    public function getMetaProperty() {
        return $this->metaProperty;
    }

    public function actions() {
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

    public function actionView($category, $id) {


        $loadmodel = $this->loadModel($id);
        $this->pageTitle = CHtml::encode($loadmodel->title);

        if ($category == "realty") {
            Yii::app()->clientScript->registerScriptFile('http://cs.etagi.com/account/ru/portal/utf8/46/');
        }



        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Last-Modified: " . date("r", strtotime($loadmodel['publish'])));
        header("Expires: " . date("r"));

        //Генерация ключевых слов
        if (empty($loadmodel->metakey)) {
            $words = Article::model()->getMeta($loadmodel);
            if ($words) {
                $news = $loadmodel;
                $news->metakey = $words;
                $news->save();
            } else
                $words = '';
        } else {
            $words = $loadmodel['metakey'];
        }


        Yii::app()->clientScript->registerMetaTag(($loadmodel['author_alias']) ? $loadmodel['author_alias'] : $loadmodel->author0->name, 'author');
        Yii::app()->clientScript->registerMetaTag($words, 'keywords');
        Yii::app()->clientScript->registerMetaTag(date('M, d Y h:i A', strtotime($loadmodel['publish'])), 'date');
        Yii::app()->clientScript->registerMetaTag(Helper::trimText($loadmodel['fulltext']), 'description');
        Yii::app()->clientScript->registerMetaTag('index, follow, archive, imageindex', 'robots');

        $this->layout = '//layouts/news/article';
        $this->setPageTitle($loadmodel['title']); #; . Yii::app()->name);
        $this->addMetaProperty('og:title', $loadmodel['title']);
        $this->addMetaProperty('og:type', 'article');
        $this->addMetaProperty('og:description', $loadmodel['introtext']);
        $this->addMetaProperty('og:url', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
        (is_file('images/news/main/' . $loadmodel['id'] . '_item.jpg')) ? $this->addMetaProperty('og:image', 'http://' . $_SERVER['SERVER_NAME'] . '/images/news/main/' . $loadmodel['id'] . '_item.jpg') : '';
        $this->addMetaProperty('og:site_name', Yii::app()->name);

        /* Подгружаем форму добавления комментария */
        if ($loadmodel['comment_on'] == 1 AND Yii::app()->params->comments == true) {

            $comment = new CommentForm();

            if (isset($_POST['ajax'])) {
                echo CActiveForm::validate($comment);
                Yii::app()->end();
            }
            if (isset($_POST['CommentForm'])) {
                $comment->attributes = $_POST['CommentForm'];
                #CVarDumper::dump($comment->attributes);
                //Записываем в куки дабы не потерять текст коммента
                Yii::app()->request->cookies['comment_username'] = new CHttpCookie('comment_username', $comment->username);
                $ct = new CHttpCookie($id . '_comment_text', $comment->text);
                $ct->expire = time() + 60 * 60 * 24 * 7;
                Yii::app()->request->cookies[$id . '_comment_text'] = $ct;
                Yii::app()->request->cookies[$id . '_comment_capcha'] = new CHttpCookie($id . '_comment_capcha', $comment->capcha);


                if ($comment->validate()) {

                    //Записываем имя в куки
                    $cookie = new CHttpCookie('comment_author', $comment->username);
                    $cookie->expire = time() + 60 * 60 * 24 * 5;
                    Yii::app()->request->cookies['comment_author'] = $cookie;



                    /* Добавляем комментарий */
                    $comm = new Comment;
                    $comm->text = $comment->text;
                    $comm->author_id = $comment->author_id;
                    $comm->name = $comment->username;
                    $comm->email = $comment->email;
                    $comm->ip = $_SERVER['REMOTE_ADDR'];
                    $comm->created = date('Y-m-d H:i:s');
                    $comm->published = Yii::app()->params->autopublishcomment;
                    $comm->object_type_id = 1;
                    $comm->object_id = $loadmodel['id'];
                    $comm->parent = ($comment->parent) ? $comment->parent : 0;
                    #CVarDumper::dump($comm);
                    $comm->save();
                    if ($comm->id > 0) {

                        unset(Yii::app()->request->cookies[$id . '_comment_text']);

                        $commadd = new CommentAdd;
                        $commadd->comment_id = $comm->id;
                        $commadd->save();
                        Yii::app()->user->setFlash('info', 'Комментарий успешно добавлен.');

                        $comment->text = '';
                        $comment->capcha = '';

                        Yii::app()->cache->flush();

                        $modif = Modified::model()->findByPk(1);
                        $modif->date = date('Y-m-d H:i:s');
                        $modif->save();

                        $this->refresh(true, '#' . $comm->id);
                    } else
                        $this->refresh(true, '#addcomment');
                    Yii::app()->user->setFlash('error', 'Ошибка добавления комментария. ');
                } else
                    Yii::app()->user->setFlash('error', 'Ошибка добавления комментария. ');
                $this->refresh(true, '#addcomment');
            }
        } else
            $comment = false;


//        $loadmodel = Yii::app()->cache->get('news_' . $id);
//        if ($loadmodel === false) {
//            #die();
//            Yii::app()->cache->set('news_' . $id, $this->loadModel($id));
//            Yii::trace('Просмотр новости. Берем не из кеша.');
//            $loadmodel = $this->loadModel($id);
//            #print_r($loadmodel);die('121212');
//
//            $condition = new CDbCriteria;
//            $condition->addCondition('id != ' . $loadmodel['id']);
//            $condition->addCondition('cat_id = ' . $loadmodel['cat_id']);
//            $condition->addCondition('publish <= NOW()');
//            $condition->addCondition('created <= NOW()');
//            $condition->limit = 4;
//            $condition->order = '`publish` DESC';
//            $moreArticles = Article::model()->findAll($condition);
//        }
//        $moreArticles = Yii::app()->cache->get('moreArticles_' . $id);
//        if ($moreArticles === false) {
//            $condition = new CDbCriteria;
//            $condition->addCondition('id != ' . $loadmodel['id']);
//            $condition->addCondition('cat_id = ' . $loadmodel['cat_id']);
//            $condition->addCondition('publish <= NOW()');
//            $condition->addCondition('created <= NOW()');
//            $condition->limit = 4;
//            $condition->order = '`publish` DESC';
//            $moreArticles = Article::model()->findAll($condition);
//        } else
//            Yii::trace('Просмотр новости. Берем из кеша.');








        /* end.Подгружаем форму добавления комментария */

        //Комментарии
        if (Yii::app()->user->checkAccess('administrator')) {
            $comments = Comment::model()->findAll(array('condition' => 'object_id = ' . $loadmodel['id'] . ' AND object_type_id = 1'));
        } else
            $comments = Comment::model()->published()->findAll(array('condition' => 'object_id = ' . $loadmodel['id'] . ' AND object_type_id = 1'));

        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.scripts') . '/comments.js'
                ), CClientScript::POS_END
        );

        $photos = Article::model()->getPhotos($id);

        //Плюсуем + 1 к просмотру
        Yii::app()->db->createCommand('UPDATE {{article_add}} SET hits =  hits + 1 WHERE article_id = ' . $id)->execute();
        $this->render('view', array(
            'model' => $loadmodel, //$this->loadModel($id),
            'commentform' => $comment,
            'comments' => $comments,
            'photos' => $photos,
            'moreArticles' => $moreArticles,
        ));
    }

    public function loadModel($id) {
        $model = Article::model()->find(
                array(
                    'limit' => 1,
                    'condition' => 'id = ' . $id,
        ));

//        $add = ArticleAdd::model()->findByPk($id);
//        if (!$add) {
//            $add = new ArticleAdd();
//            $add->article_id = $model->id;
//        }
//        $add->hits++;
//        $add->save();

        if ($model === false)
            throw new CHttpException(404, 'Такой статьи в базе не найдено.');
        return $model;
    }

    public function actionIndex($category = null, $page = 1) {

        if ($category == false)
            $category = Article::model()->getNewscat();

        if ($category == 'megapolis') {
            $this->redirect('society');
            Yii::app()->end();
        }
        if ($category == "realty") {
            Yii::app()->clientScript->registerScriptFile('http://cs.etagi.com/account/ru/portal/utf8/46/');
        }

        if (!is_array($category)) {
            /* Пагинация */
            $criteria = new CDbCriteria();
            $count = Article::model()->getCountitems($category);
            $pages = new CPagination($count);
            $pages->pageSize = Config::getOnpage();

            /* end.Пагинация */
            if ($category == 'opinion') {
                $mainNews = NULL;
                $data = Article::model()->getItems(array(8, 9), 20, $page);
            } else {
                $mainNews = Article::model()->getMainitem($category, true);
                $data = Article::model()->getItems($category, 20, $page);
            }

            $cat = Article::model()->getCategory($category);

            $this->render($category == 'official' ? 'official' : 'index', array(
                'dataProvider' => $data,
                'mainNews' => $mainNews,
                'category' => $cat,
                'pages' => $pages,
            ));
            return;
        }
        
        #CVarDumper::dump($_GET);
        $page = $_GET['page'];
        $criteria = new CDbCriteria();
        $count = Article::model()->getCountitems($category);

        $pages = new CPagination($count);
        // элементов на страницу
        $pages->pageSize = Config::getOnpage();
//        $pages->route = 'news/all';
        #$pages->applyLimit($criteria);

        $data = Article::model()->getItems(Article::model()->getNewscat(), Config::getOnpage(), $page);
        $this->render('index', array(
            'dataProvider' => $data,
            'pages' => $pages,
        ));
    }

}
