<?php

class OldController extends Controller {

    public $layout = '//layouts/index';

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

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionView($category, $id) {

        $newid = ArticleMigrate::model()->find('id_old = ' . (int) $id)->id_new;
        if($newid)
            $this->redirect('/news/'.$category.'/'.$newid, true, 301);
        else
            $this->redirect('/', true, 301);
    }
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->layout = '//layouts/main';

    }

    public function actionRules() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        #$this->layout = '//layouts/main';
        $this->render('rules');
    }



}