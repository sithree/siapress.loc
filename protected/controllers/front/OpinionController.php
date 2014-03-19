<?php

class OpinionController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';
    public $metaProperty;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'CHttpCacheFilter + index',
                'lastModified' => Modified::model()->findByPk(1)->date,
                'cacheControl' => 'max-age=180, private',
            ),

        );
    }
    public function addMetaProperty($name,$content){
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty(){
        return  $this->metaProperty;
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'captcha', 'view', 'politics', 'economics', 'society', 'megapolis', 'incident', 'sport', 'life', 'opinion', 'noise'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $loadmodel = Yii::app()->cache->get('news_' . $id);
        if ($loadmodel === false) {
            #die();
            Yii::app()->cache->set('news_' . $id, $this->loadModel($id));
            Yii::trace('Просмотр новости. Берем не из кеша.');
            $loadmodel = $this->loadModel($id);
        } else
            Yii::trace('Просмотр новости. Берем из кеша.');

        //META Tegi
        if (empty($loadmodel['metakey'])) {
            $words = Article::model()->getMeta($loadmodel);
            if ($words) {
                $news = Article::model()->findByPk($loadmodel['id']);
                $news->metakey =  $words;
                $news->save();
            }
            else
                $words = '';
        } else {
            $words = $loadmodel['metakey'];
        }

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
                $ct = new CHttpCookie($id .'_comment_text', $comment->text);
                $ct->expire = time()+60*60*24*180; 
                Yii::app()->request->cookies[$id .'_comment_text'] = $ct;
                Yii::app()->request->cookies[$id .'_comment_capcha'] = new CHttpCookie($id .'_comment_capcha', $comment->capcha);
                
                
                if ($comment->validate()) {
                     /* Добавляем комментарий */
                    $comm = new Comment;
                    $comm->text = $comment->text;
                    $comm->author_id = $comment->author_id;
                    $comm->name = $comment->username;
                    $comm->email = $comment->email;
                    $comm->ip = $_SERVER['REMOTE_ADDR'];
                    $comm->created = date('Y-m-d H:i:s', time());
                    $comm->published = Yii::app()->params->autopublishcomment;
                    $comm->object_type_id = 1;
                    $comm->object_id = $loadmodel['id'];
                    $comm->parent = ($comment->parent) ? $comment->parent : 0;
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

       //Комментарии
        $comments = Comment::model()->published()->findAll('object_id = ' . $loadmodel['id'] . ' AND object_type_id = 1');
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('webroot.scripts') . '/comments.js'
                ), CClientScript::POS_END
        );

        //Плюсуем + 1 к просмотру
        Yii::app()->db->createCommand('UPDATE {{article_add}} SET hits =  hits + 1 WHERE article_id = ' . $id)->execute();

        $this->render('view', array(
            'model' => $loadmodel, //$this->loadModel($id),
            'commentform' => $comment,
            'comments' => $comments
        ));
    }

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'MCaptcha',
                'maxLength' => 4,
                'minLength' => 4,
                'transparent' => true,
            ),
                #'captchaAdction' => 'site/index'
        );
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

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = Yii::app()->cache->get('opinion');
        if ($dataProvider === false) {
            $d = Article::model()->getItems('opinion', '15', 0);

            Yii::app()->cache->set('opinion', $d);
            $dataProvider = $d;
        }
        #CVarDumper::dump($d);
        #Yii::app()->end();

        $this->render('index', array(
            'dataProvider' => $dataProvider,
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
        if ($model === false)
            throw new CHttpException(404, 'Такой статьи в базе не найдено.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'article-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
