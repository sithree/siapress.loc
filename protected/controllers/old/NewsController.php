<?php

class NewsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/news/article';
    public $metaProperty;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'CHttpCacheFilter',
                'lastModified' => Yii::app()->db->createCommand("SELECT MAX(`publish`) FROM {{articles}} where `published` = 1 order by `publish` desc")->queryScalar(),
                'cacheControl' => 'no-store, no-cache, must-revalidate',
            ),
        );
    }

    public function addMetaProperty($name, $content) {
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty() {
        return $this->metaProperty;
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'captcha', 'politics', 'page', 'economics', 'society', 'megapolis', 'incident', 'sport', 'life', 'opinion', 'noise'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        #$this->layout = '';
        #Yii::app()->cache->flush();

        $actions = $this->getActionParams();
        if ($actions['category'] == 'megapolis') {
            $this->redirect(array('news/view', 'category' => 'society', 'id' => $actions['id']));
            Yii::app()->end();
        }
        $loadmodel = Yii::app()->cache->get('news_' . $id);
        if ($loadmodel === false) {
            #die();
            Yii::app()->cache->set('news_' . $id, $this->loadModel($id));
            Yii::trace('Просмотр новости. Берем не из кеша.');
            $loadmodel = $this->loadModel($id);
            #print_r($loadmodel);die('121212');
        } else
            Yii::trace('Просмотр новости. Берем из кеша.');

        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Last-Modified: " . date("r", strtotime($loadmodel['publish'])));
        header("Expires: " . date("r"));

        //META Tegi
        if (empty($loadmodel['metakey'])) {
            $words = Article::model()->getMeta($loadmodel);
            if ($words) {
                $news = Article::model()->findByPk($loadmodel['id']);
                $news->metakey = $words;
                $news->save();
            }
            else
                $words = '';
        } else {
            $words = $loadmodel['metakey'];
        }


        Yii::app()->clientScript->registerMetaTag(($loadmodel['author_alias']) ? $loadmodel['author_alias'] : $loadmodel['name'], 'author');
        Yii::app()->clientScript->registerMetaTag($words, 'keywords');
        Yii::app()->clientScript->registerMetaTag(date('M, d Y h:i A', strtotime($loadmodel['publish'])), 'data');
        Yii::app()->clientScript->registerMetaTag(Helper::trimText($loadmodel['fulltext']), 'description');
        Yii::app()->clientScript->registerMetaTag('index, follow, archive, imageindex', 'robots');

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
                if ($comment->validate()) {
                    /* Добавляем комментарий */
                    $comm = new Comment;
                    $comm->text = $comment->text;
                    $comm->author_id = $comment->author_id;
                    $comm->name = $comment->username;
                    $comm->email = $comment->email;
                    $comm->ip = $_SERVER['REMOTE_ADDR'];
                    $comm->created = date('Y-m-d H:i:s', time() + 7200);
                    $comm->published = Yii::app()->params->autopublishcomment;
                    $comm->object_type_id = 1;
                    $comm->object_id = $loadmodel['id'];
                    #CVarDumper::dump($comm);
                    $comm->save();
                    if ($comm->id > 0) {
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
                    }
                    else
                        Yii::app()->user->setFlash('error', 'Ошибка добавления комментария. ');

                    /* end.Добавляем комментарий */
                }
            }
        } else
            $comment = false;
        /* end.Подгружаем форму добавления комментария */

        $comments = Comment::model()->getAllComments($loadmodel['id']);
        $photos = Article::model()->getPhotos($id);

        //Плюсуем + 1 к просмотру
        Yii::app()->db->createCommand('UPDATE {{article_add}} SET hits =  hits + 1 WHERE article_id = ' . $id)->execute();

        $this->render('view', array(
            'model' => $loadmodel, //$this->loadModel($id),
            'commentform' => $comment,
            'comments' => $comments,
            'photos' => $photos,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Article;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /*
      public function actionPolitics($id = null, $page = 0) {
      if (!is_null($id)) {
      $loadmodel = $this->loadModel($id);
      $this->render('view', array(
      'model' => $loadmodel, //$this->loadModel($id),
      ));
      return;
      }
      /* Пагинация *//*
      $criteria = new CDbCriteria();
      $count = Article::model()->getCountitems('politics');
      $pages = new CPagination($count);
      $pages->pageSize = Config::getOnpage();
      /* end.Пагинация */
    /*
      if (isset($_GET['page']))
      $page = intval($page);

      $mainNews = Article::model()->getMainitem($this->action->id);
      $data = Article::model()->getItems($this->action->id, 20, $page);
      $cat = Article::model()->getCategory($this->action->id);

      $this->render('index', array(
      'dataProvider' => $data,
      'mainNews' => $mainNews,
      'category' => $cat,
      'pages' => $pages,
      ));
      }
     */

    public function actionOpinion($id = null, $page = 0) {
        if ($id) {
            $loadmodel = $this->loadModel($id);
            $this->render('view', array(
                'model' => $loadmodel, //$this->loadModel($id),
            ));
            return;
        }
        /* Пагинация */
        $criteria = new CDbCriteria();
        $count = Article::model()->getCountitems('opinion');
        $pages = new CPagination($count);
        $pages->pageSize = Config::getOnpage();
        /* end.Пагинация */
        $mainNews = Article::model()->getMainitem($this->action->id);
        $data = Article::model()->getItems($this->action->id, 20, $page);
        $cat = Article::model()->getCategory($this->action->id);

        $this->render('index', array(
            'dataProvider' => $data,
            'mainNews' => $mainNews,
            'category' => $cat,
            'pages' => $pages,
        ));
    }

    public function actionNoise($id = null, $page = 0) {
        if ($id) {
            $loadmodel = $this->loadModel($id);
            $this->render('view', array(
                'model' => $loadmodel, //$this->loadModel($id),
            ));
            return;
        }
        /* Пагинация */
        $criteria = new CDbCriteria();
        $count = Article::model()->getCountitems('noise');
        $pages = new CPagination($count);
        $pages->pageSize = Config::getOnpage();
        /* end.Пагинация */

        $mainNews = Article::model()->getMainitem($this->action->id);
        $data = Article::model()->getItems($this->action->id, 20, $page);
        $cat = Article::model()->getCategory($this->action->id);

        $this->render('index', array(
            'dataProvider' => $data,
            'mainNews' => $mainNews,
            'category' => $cat,
            'pages' => $pages,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($category = null, $page = 1) {
        #CVarDumper::dump($this->action);
        #die();
        if ($category == null)
            $category = Article::model()->getNewscat();

        if ($category == 'megapolis') {
            $this->redirect('society');
            Yii::app()->end();
        }



        if (!is_array($category)) {
            /* Пагинация */
            $criteria = new CDbCriteria();
            $count = Article::model()->getCountitems($category);
            $pages = new CPagination($count);
            $pages->pageSize = Config::getOnpage();
            /* end.Пагинация */

            $mainNews = Article::model()->getMainitem($category, true);
            $data = Article::model()->getItems($category, 20, $page);
            $cat = Article::model()->getCategory($category);

            $this->render('index', array(
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
        $pages->route = 'news/index';
        #$pages->applyLimit($criteria);

        $data = Article::model()->getItems(Article::model()->getNewscat(), Config::getOnpage(), $page);
        $this->render('all', array(
            'dataProvider' => $data,
            'pages' => $pages,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Article('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Article']))
            $model->attributes = $_GET['Article'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        #$model = Article::model()->findByPk($id);
        $model = Article::model()->findArticle($id);
        #print_r($model); die();
        if ($model === false)
            throw new CHttpException(404, 'Такой статьи в базе не найдено.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'CommentForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
