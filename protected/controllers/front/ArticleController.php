<?php

class ArticleController extends Controller
{

    public $layout = '//layouts/news/article';
    public $metaProperty;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'CHttpCacheFilter',
                'lastModified' => date('Y-m-d H:i:s'), // Yii::app()->db->createCommand("SELECT MAX(`publish`) FROM {{articles}} where `published` = 1 order by `publish` desc")->queryScalar(),
                'cacheControl' => 'no-store, no-cache, must-revalidate',
            ),
        );
    }

    public function addMetaProperty($name, $content)
    {
        $this->metaProperty .= "<meta property=\"" . CHtml::encode($name) . "\" content=\"" . CHtml::encode($content) . "\" />\r\n";
    }

    public function getMetaProperty()
    {
        return $this->metaProperty;
    }

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

    public function actionDislike($id)
    {
        $article = ArticleAdd::model()->find('article_id=' . $id);
        if (!$article)
        {
            $article = new ArticleAdd();
            $article->article_id = $id;
        }
        $article->dislike++;
        $article->save();
        $cookie = new CHttpCookie('articlelike_' . $article->article_id, '1');
        $cookie->expire = time() + 86400;
        Yii::app()->request->cookies['articlelike_' . $article->article_id] = $cookie;

        if (Yii::app()->request->isAjaxRequest)
        {
            echo $this->renderPartial('vote', array('model' => $article));
            Yii::app()->end();
        }
        $this->redirect(Yii::app()->request->urlReferrer);
        Yii::app()->end();
    }

    public function actionLike($id)
    {
        $article = ArticleAdd::model()->find('article_id=' . $id);
        if (!$article)
        {
            $article = new ArticleAdd();
            $article->article_id = $id;
        }
        $article->like++;
        $article->save();
        $cookie = new CHttpCookie('articlelike_' . $article->article_id, '1');
        $cookie->expire = time() + 86400;
        Yii::app()->request->cookies['articlelike_' . $article->article_id] = $cookie;

        if (Yii::app()->request->isAjaxRequest)
        {
            echo $this->renderPartial('vote', array('model' => $article));
            Yii::app()->end();
        }
        $this->redirect(Yii::app()->request->urlReferrer);
        Yii::app()->end();
    }

    public function actionView($category, $id)
    {


        $loadmodel = $this->loadModel($id);
        $this->pageTitle = CHtml::encode($loadmodel->title);

        if ($category == "realty")
        {
            Yii::app()->clientScript->registerScriptFile('http://cs.etagi.com/account/ru/portal/utf8/46/');
        }



        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Last-Modified: " . date("r", strtotime($loadmodel['publish'])));
        header("Expires: " . date("r"));

        //Генерация ключевых слов
        if (empty($loadmodel->metakey))
        {
            $words = Article::model()->getMeta($loadmodel);
            if ($words)
            {
                $news = $loadmodel;
                $news->metakey = $words;
                $news->save();
            } else
                $words = '';
        } else
        {
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


        (is_file('images/news/main/' . $loadmodel['id'] . '_230x0@2x.jpg')) ? $this->addMetaProperty('og:image', 'http://' . $_SERVER['SERVER_NAME'] . '/images/news/main/' . $loadmodel['id'] . '_230x0@2x.jpg') : '';
        $this->addMetaProperty('og:site_name', Yii::app()->name);


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

        $photos = Article::model()->getPhotos($id);

        //Плюсуем + 1 к просмотру
        Yii::app()->db->createCommand('UPDATE {{article_add}} SET hits =  hits + 1 WHERE article_id = ' . $id)->execute();
        $this->render('view', array(
            'model' => $loadmodel, //$this->loadModel($id),
            'photos' => $photos,
                //'moreArticles' => $moreArticles,
        ));
    }

    public function loadModel($id)
    {
        $model = Article::model()->find(
                array(
                    'limit' => 1,
                    'condition' => 'id = ' . $id . ' and published = 1 and publish <= ' . new CDbExpression('NOW()'),
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

    public function actionIndex($category = null, $page = 1)
    {

        if ($category == false)
            $category = Article::model()->getNewscat();

        switch ($category)
        {
            case "opinions":
                $category = Article::getOpinionsCategories(true);
                $this->pageTitle = "Все мнения на портале СИА-ПРЕСС";
                break;

            case "online":
                $category = Article::getOnlineProjectsCategories(true);
                $this->pageTitle = "Все онлайн-проекты СИА-ПРЕСС";
                break;

            case "news":
                $this->pageTitle = "Все новости Сургута и Югры на СИА-ПРЕСС";
                $category = Article::getNewsCategories(true);
                break;
            case "photos":
                $this->pageTitle = "Все фото-проекты портала СИА-ПРЕСС";
                $category = Article::getPhotosCategories(true);
                break;
            case "special":
                $this->pageTitle = "Все спецпроекты портала СИА-ПРЕСС";
                $category = Article::getSpecialCategories(true);
                break;
            case "oldsurgut":
                $this->pageTitle = "Старый Сургут";
                $category = Article::getOldSurgutCategories(true);
                break;

            default:
                break;
        }


        if ($category == "realty")
        {
            Yii::app()->clientScript->registerScriptFile('http://cs.etagi.com/account/ru/portal/utf8/46/');
        }

        if (!is_array($category))
        {
            /* Пагинация */
            $criteria = new CDbCriteria();
            $count = Article::model()->getCountitems($category);
            $pages = new CPagination($count);
            $pages->pageSize = Config::getOnpage();

            /* end.Пагинация */
            if ($category == 'opinion')
            {
                $mainNews = NULL;
                $data = Article::model()->getItems(array(8, 9), 20, $page);
            } else
            {
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

//        CVarDumper::dump($count);
//        die();
        $pages = new CPagination($count);
        // элементов на страницу
        $pages->pageSize = Config::getOnpage();
        if ($pages->currentPage > 0)
        {
            $this->pageTitle .= ". Страница " . (string) ($pages->currentPage + 1);
        }
//        $pages->route = 'news/all';
        #$pages->applyLimit($criteria);

        $data = Article::model()->getItems($category, Config::getOnpage(), $page);
        $this->render('index', array(
            'dataProvider' => $data,
            'pages' => $pages,
        ));
    }

}
