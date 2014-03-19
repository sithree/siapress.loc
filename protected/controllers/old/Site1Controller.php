<?php

class SiteController extends Controller {

    public $layout = '//layouts/index';
    public $metaProperty;

    public function addMetaProperty($name, $content) {
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty() {
        return $this->metaProperty;
    }

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
            'sitemap' => array(
                'class' => 'ext.sitemap.ESitemapAction',
            ),
            'sitemapxml' => array(
                'class' => 'ext.sitemap.ESitemapXMLAction',
                'classConfig' => array(
                    array('baseModel' => 'Article',
                        'route' => '/news/view',
                        'params' => array('category' => 'ccc', 'id' => 'id')),
                ),
                'importListMethod' => 'getBaseSitePageList',
            ),
        );
    }

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

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Expires: " . date("r"));

        $this->addMetaProperty('og:url', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
        $this->addMetaProperty('og:image', 'http://www.siapress.ru/images/logo.png');
        $this->addMetaProperty('og:site_name', Yii::app()->name);

        Yii::app()->clientScript->registerMetaTag('новости сургута, сургут новости, ХМАО, Югра, статьи, интервью, форум, блоги, происшествия, фото, фоторепортаж, погода, курс валют, информационный портал, сайт, лента, интересно, пресса, сми', 'keywords');
        Yii::app()->clientScript->registerMetaTag('Новости Сургута и Югры, ХМАО, региональной политики, экономики, культуры, важнейшие спортивные события, комментарии, аналитика, блоги.', 'description');
        Yii::app()->clientScript->registerMetaTag('Редакция СИА-ПРЕСС', 'author');
        Yii::app()->clientScript->registerMetaTag('index, follow, archive, imageindex', 'robots');

        $this->layout = '//layouts/main';
        $this->render('index');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionSearch() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Expires: " . date("r"));

        Yii::app()->clientScript->registerMetaTag('noindex,noarchive', 'robots');
        $model = new SearchForm;
        $result = '';

        if (isset($_GET['SearchForm'])) {
            $model->attributes = $_GET['SearchForm'];

            if ($model->validate()) {
                $criteria = new CDbCriteria();
                $cat_id = ($model->category) ? $model->category : implode(' OR cat_id =', Article::model()->getNewscat());
                $author = (trim($model->author)) ? 'AND   author_alias like "%' . trim($model->author) . '%" OR author0.name  LIKE "%' . $model->author . '%"' : '';

                $criteria->condition = ' t.published = 1 ' . $author . ' AND(cat_id=' . $cat_id . ') AND (title LIKE :text OR `fulltext` like :text) ';
                $criteria->params = array(':text' => '%' . str_replace(' ', '%', trim($model->text)) . '%');
                $criteria->with = array('category', 'author0');
                $criteria->order = 't.id DESC';
                $criteria->limit = 100;
                $result = Article::model()->findAll($criteria);
            }
        }

        $this->layout = '//layouts/news/article';
        $this->render('search', array('model' => $model, 'results' => $result));
    }

    public function actionRules() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->layout = '//layouts/news/article';
        $this->render('rules');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/news/article';
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

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        #CVarDumper::dump(Yii::app()->user);
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/');
            return;
        }

        $service = Yii::app()->request->getQuery('service');
        Yii::app()->user->returnUrl = $_SERVER['HTTP_REFERER'];

        if (isset($service)) {
            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('site/login');

            if ($authIdentity->authenticate()) {
                $identity = new ServiceUserIdentity($authIdentity);

                // успешная авторизация
                if ($identity->authenticate()) {
                    // проверяем, есть ли такой пользователь
                    // социальной сети у нас в базе
                    if (Users::model()->checkSocial($identity)) {
                        Yii::app()->user->login($identity, 3600 * 24 * 30);
                        $authIdentity->redirect();
                    } else {
                        if (Users::model()->createSocialUser($identity)) {
                            Yii::app()->user->login($identity);
                            $authIdentity->redirect();
                        }
                    }
                    // специальное перенаправления для корректного закрытия всплывающего окна
                    $authIdentity->cancel();
                } else {
                    // закрытие всплывающего окна и перенаправление на cancelUrl
                    $authIdentity->cancel();
                }
            }

            // авторизация не удалась, перенаправляем на страницу входа
            $this->redirect(array('site/login'));
        }
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

    public function actionRegistration() {
        $this->layout = '//layouts/news/article';

        if (Yii::app()->request->getQuery('token')) {
            $user = Users::model()->find('token = "' . Yii::app()->request->getQuery('token') . '" AND `active` = 0 AND `moderation` = 0 ');
           # die($user->id);
            if ($user->id) {
                $user->active = 1;
                $user->token = '';
                $user->save();

                $this->render('_user_confirm');
            } else {
                $this->render('error404', 404);
            }
        }

        $model = new RegistrationForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['RegistrationForm'])) {
            #$this->redirect(Yii::app()->user->returnUrl);
            $model->attributes = $_POST['RegistrationForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                #die($model->avatar);
                $user = new Users;
                $user->username = $model->login;
                $user->name = $model->username;
                $user->email = $model->email;
                $user->phone = $model->phone ? $model->phone : '';
                $user->address = $model->address ? $model->address : '';
                $user->password = $user->hashPassword($model->password);
                $user->active = 0;
                $user->moderation = 0;
                $user->block = 0;
                $user->login_from = 1;
                $user->perm_id = 5;
                $user->register_date = new CDbExpression('NOW()');
                
                $user->token = md5($user->register_date . $user->username . $user->email);
                $user->last_visit = new CDbExpression('NOW()');

                $user->level = 1;
                $user->occupation = $model->occupation ? $model->occupation : '';
                $user->about = $model->about ? $model->about : '';

                $user->save();

                if ($user->id) {
                    $name = '=?UTF-8?B?' . base64_encode('Сайт СИА-ПРЕСС') . '?=';
                    $subject = '=?UTF-8?B?' . base64_encode('Подтверждение регистрации на сайте') . '?=';
                    $headers = "From: $name <no-reply@siapress.ru>\r\n" .
                            "MIME-Version: 1.0\r\n" .
                            "Content-type: text/html; charset=UTF-8";

                    $text = '<p>Здравствуйте!</p>';
                    $text .= '<p>Вы, или кто-то за Вас, заегистрировались на сайте <a href="http://www.siapress.ru">siapress.ru</a>. Для пожтверждения регистрации пройдите по <a href="http://www.siapress.ru/registration?token=' .
                            $user->token . '">ссылке</a>.</p>';
                    $text .= '<p>Если вы не регистрировались на сайте, удалите это письмо.</p>';
                    $text .= '<p>________________</p>';
                    $text .= '<p>С уважением, команда сайта СИА-ПРЕСС</p>';

                    mail($model->email, $subject, $text, $headers);

                    Yii::app()->user->setFlash('register', 'На Ваш почтовый ящик отправлено письмо с ссылкой на подтверждения email. Пожалуйста, пройдите по ней для продолжения.');

                    $this->refresh();

//Сохраняем аватарку
                    /*
                     * $tmpPath = Yii::getPathOfAlias('webroot.temp');
                      $model->avatar = CUploadedFile::getInstance($model, 'avatar');

                      $result = $model->avatar->saveAs($tmpPath . DIRECTORY_SEPARATOR . $model->avatar);

                      //Если аватарка успешна сохранена во временную папку
                      if ($result) {
                      $user->setAvatar($tmpPath . DIRECTORY_SEPARATOR . $this->image);
                      }
                     *

                      //АВТОРИЗАЦИЯ
                      $login = new LoginForm;
                      $login->username = $model->login;
                      $login->password = $model->password;
                      if ($login->login()) {
                      $this->redirect('/');
                      }
                     */
                }
            }
        }
        $this->render('registration', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionBugreport() {
        $this->layout = '//layouts/main';
        $this->render('bugreport');
    }

    public function getBaseSitePageList() {

        $list = Yii::app()->cache->get('sitemapxml');
        if ($list === false) {
            $list = array(
                array(
                    'loc' => Yii::app()->createAbsoluteUrl('/'),
                    'frequency' => 'always',
                    'priority' => '1',
                ),
                array(
                    'loc' => Yii::app()->createAbsoluteUrl('/rules'),
                    'frequency' => 'monthly',
                    'priority' => '0.5',
                ),
            );
        }
        Yii::app()->cache->set('sitemapxml', $list, 3600);

        return $list;
    }

}