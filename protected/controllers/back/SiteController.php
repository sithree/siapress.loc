<?php

class SiteController extends BackEndController {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/main';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
            if ($error['code'] == 404)
                $this->render('error404', $error);
            else
                $this->render('error', $error);
        }
    }

    public function actionIndex() {

        $this->redirect(array('article/index'));
        $this->render('index');
    }
    public function actionPassword() {
        $pas = Yii::app()->request->getQuery('pass');
        if($pas){
            $user = new Users;
            $this->render('pass',array('pass' => $user->hashPassword($pas)));
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '//layouts/login';
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/');
            return;
        }
        $service = Yii::app()->request->getQuery('service');
        Yii::app()->user->returnUrl = $_SERVER['HTTP_REFERER'];

        //Конец авторизации через социальные сети

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}