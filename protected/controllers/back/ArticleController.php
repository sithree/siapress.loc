<?php

class ArticleController extends BackEndController {

    /**
     * @return array action filters
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'MCaptcha',
                'maxLength' => 5,
                'minLength' => 5,
                'transparent' => true,
                'testLimit' => 0,
                'foreColor' => 0xC2C2C2,
                'width' => 80,
                'height' => 40,
            ),
                #'captchaAdction' => 'site/index'
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $loadmodel = $this->loadModel($id);

        $this->render('view', array(
            'model' => $loadmodel,
            'commentform' => $comment,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionNew() {
        $model = new Article;
        $videos = array();

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->save();
        }

        if (!empty($_POST['ArticleVideo'])) {
            //if ($model->id)
            //    ArticleVideo::model()->findAll('article = ' . $model->id)->delete();

            foreach ($_POST['ArticleVideo'] as $video) {
                $m = new ArticleVideo;
                $m->setAttributes($video);
                $m->article = $model->id ? $model->id : 0;
                if ($m->validate())
                    $videos[] = $m;
            }
        }

        if (count($videos) > 0 && $model->id) {

            foreach ($videos as $m) {
                $m->save();
            }
        } else {
            $videos[] = new ArticleVideo;
        }

        if ($model->id) {
            switch ($_POST['actionButton'][0]) {
                case 'saveNew':
                    #$this->refresh();
                    $this->redirect(array('article/new'));
                    break;
                case 'saveClose':
                    $this->redirect(array('article/index'));
                    break;
                case 'save':
                    $this->redirect(array('article/edit', 'id' => $model->id));
                    break;

                default:
                    break;
            }
        }
        $this->render('create', array(
            'model' => $model,
            'videos' => $videos,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionEdit($id) {
        $model = $this->loadModel($id);
        $videos = ArticleVideo::model()->findAll('article = ' . $id);
        if (!$videos) {
            $videos = array();
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (!empty($_POST['ArticleVideo'])) {
            //if ($model->id)
            //    ArticleVideo::model()->findAll('article = ' . $model->id)->delete();

            foreach ($_POST['ArticleVideo'] as $video) {
                ArticleVideo::model()->deleteAll('article = ' . $model->id);
                $m = new ArticleVideo;
                $m->setAttributes($video);
                $m->article = $model->id ? $model->id : 0;
                if ($m->validate())
                    $videos[] = $m;
            }
        }

        if (count($videos) > 0 && $model->id) {

            foreach ($videos as $m) {

                $m->save();
            }
        } else {
            $videos[] = new ArticleVideo;
        }

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->save();
        }

        if ($model->id) {
            switch ($_POST['actionButton'][0]) {
                case 'saveNew':
                    #$this->refresh();
                    $this->redirect(array('article/new'));
                    break;
                case 'saveClose':
                    $this->redirect(array('article/index'));
                    break;
                case 'save':
                    $this->redirect(array('article/edit', 'id' => $model->id));
                    break;

                default:
                    break;
            }
        }
        $this->render('edit', array(
            'model' => $model,
            'videos' => $videos,
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
            ArticleVideo::model()->deleteAll('article = ' . $id);
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
        $model = new Article('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Article']))
            $model->attributes = $_GET['Article'];

        $this->render('index', array(
            'model' => $model,
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
        $model = Article::model()->with('author0', 'category', 'articleAdd')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
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

    public function actionImageupload() {
        $image = new ImageUpload;

        $image->file = CUploadedFile::getInstanceByName('file');

        if ($image->validate()) {
            if ($image->file->saveAs(Yii::getPathOfAlias('webroot.temp') . DIRECTORY_SEPARATOR . $image->file->name)) {

                $img = new CImageHandler;
                $img->load(Yii::getPathOfAlias('webroot.temp') . DIRECTORY_SEPARATOR . $image->file->name);

                if ($img->width > 570) {
                    $img->resize(570, 620);
                }

                @mkdir(Yii::getPathOfAlias('webroot.images.news.' . date('Y')));
                @mkdir(Yii::getPathOfAlias('webroot.images.news.' . date('Y') . '.' . date('m')));
                @mkdir(Yii::getPathOfAlias('webroot.images.news.' . date('Y') . '.' . date('m') . '.' . date('d')));
                @mkdir(Yii::getPathOfAlias('webroot.images.news.' . date('Y') . '.' . date('m') . '.' . date('d') . '.thumb'));

                $path = Yii::getPathOfAlias('webroot.images.news.' . date('Y') . '.' . date('m') . '.' . date('d')) . DIRECTORY_SEPARATOR;
                $name = date('Y_m_d_his') . '.jpg';
                $img->save($path . $name, IMG_JPEG, 95);

                $img->reload();
                $img->adaptiveThumb(100, 70);
                $img->save($path . 'thumb' . DIRECTORY_SEPARATOR . $name, IMG_JPEG, 95);

                @unlink(Yii::getPathOfAlias('webroot.temp') . DIRECTORY_SEPARATOR . $image->file->name);
                $data = array(
                    'filelink' => Yii::app()->baseUrl . '/images/news/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $name
                );
                echo CJSON::encode($data);
                exit;
                Yii::app()->end();
            }
        }

        throw new CHttpException(500, CJSON::encode(
                array('error' => 'Ошибка загрузки изображения.')
        ));
    }

    public function actionUploadedImages() {
        $images = array();

        $handler = opendir(Yii::getPathOfAlias('webroot.images.news.' . date('Y') . '.' . date('m') . '.' . date('d')));

        while ($file = readdir($handler)) {
            if ($file != "." && $file != ".." && $file != "thumb")
                $images[] = $file;
        }
        closedir($handler);

        $jsonArray = array();

        foreach ($images as $image)
            $jsonArray[] = array(
                'thumb' => Yii::app()->baseUrl . '/images/news/' . date('Y') . '/' . date('m') . '/' . date('d') . '/thumb/' . $image,
                'image' => Yii::app()->baseUrl . '/images/news/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $image
            );

        header('Content-type: application/json');
        echo CJSON::encode($jsonArray);
    }

}
