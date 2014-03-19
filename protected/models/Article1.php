<?php

/**
 * This is the model class for table "{{articles}}".
 *
 * The followings are the available columns in table '{{articles}}':
 * @property integer $id
 * @property string $title
 * @property integer $cat_id
 * @property integer $published
 * @property string $introtext
 * @property string $fulltext
 * @property string $tags
 * @property integer $author
 * @property string $author_alias
 * @property integer $modif_by
 * @property string $created
 * @property string $modified
 * @property string $publish
 * @property string $metakey
 * @property integer $main
 * @property integer $type_id
 * @property integer $comment_on
 * @property string $imgtitle
 *
 * The followings are the available model relations:
 * @property ArticleAdd $articleAdd
 * @property Users[] $siaUsers
 * @property ArticleTypes $type
 * @property ArticleCategories $cat
 * @property Users $author0
 */
class Article extends CActiveRecord {

    protected $_mainId = false;
    public $ccc;
    public $image;
    public $deleteImage;
    public $_imgpath = 'images/news/main/';

    public function scopes() {
        return array(
            'sitemap' => array('with' => 'category', 'select' => 't.id, t.cat_id, `category`.`alias` as ccc', 'condition' => 't.published = 1', 'order' => 't.id DESC'),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Article the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{articles}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, cat_id, fulltext, author, created, modified, publish, type_id', 'required'),
            array('top, deleteImage, cat_id, published, author, modif_by, main, type_id, comment_on', 'numerical', 'integerOnly' => true),
            array('title, tags, author_alias, metakey, imgtitle', 'length', 'max' => 255),
            array('introtext', 'safe'),
            array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, cat_id, published, introtext, fulltext, tags, author, author_alias, modif_by, created, modified, publish, metakey, main, type_id, comment_on, imgtitle', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'articleAdd' => array(self::HAS_ONE, 'ArticleAdd', 'article_id'),
            'siaUsers' => array(self::MANY_MANY, 'Users', '{{article_users}}(article_id, user_id)'),
            'type' => array(self::BELONGS_TO, 'ArticleTypes', 'type_id'),
            'category' => array(self::BELONGS_TO, 'ArticleCategories', 'cat_id'),
            'author0' => array(self::BELONGS_TO, 'Users', 'author'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'cat_id' => 'Категория',
            'published' => 'Опубликовано',
            'introtext' => 'Вводный текст',
            'fulltext' => 'Основной текст',
            'tags' => 'Теги',
            'author' => 'Автор',
            'author_alias' => 'Псевдоним автора',
            'modif_by' => 'Изменен',
            'created' => 'Создано',
            'modified' => 'Изменено',
            'publish' => 'Опубликовано',
            'metakey' => 'Метаданные',
            'main' => 'Главная',
            'type_id' => 'Тип',
            'comment_on' => 'Комментарии',
            'imgtitle' => 'Подпись изображения',
            'top' => 'На верх (блоги)',
            'image' => 'Основное фото',
            'deleteImage' => 'Удалить фото',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('published', $this->published);
        $criteria->compare('introtext', $this->introtext, true);
        $criteria->compare('fulltext', $this->fulltext, true);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('author', $this->author);
        $criteria->compare('author_alias', $this->author_alias, true);
        $criteria->compare('modif_by', $this->modif_by);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('publish', $this->publish, true);
        $criteria->compare('metakey', $this->metakey, true);
        $criteria->compare('main', $this->main);
        $criteria->compare('top', $this->top);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('comment_on', $this->comment_on);
        $criteria->compare('imgtitle', $this->imgtitle, true);

        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 20,
                    )
                ));
    }

    public function afterConstruct() {
        if ($this->hasEventHandler('onAfterConstruct'))
            $this->onAfterConstruct(new CEvent($this));
        if ($this->isNewRecord) {
            $this->created = date('Y-m-d H:i:s');
            $this->publish = date('Y-m-d H:i:s');
            $this->modified = '0000-00-00 00:00:00';
            $this->published = 1;
        } else
            $this->modified = date('Y-m-d H:i:s');

        $this->type_id = 1;

        $this->author = Yii::app()->user->id;
    }

    public function beforeSave() {
        parent::beforeSave();

        if ($this->deleteImage)
            $this->deleteImage();

        return true;
    }

    public function afterSave() {
        if ($image = CUploadedFile::getInstance($this, 'image')) {

            #$this->deleteImage(); // старый документ удалим, потому что загружаем новый

            $this->image = $image;
            $result = $this->image->saveAs(
                    Yii::getPathOfAlias("webroot.temp") . DIRECTORY_SEPARATOR . $this->image
            );
            if ($result) {
                $this->generateImage();
            }
            #die('asdas');
        }
        $add = ArticleAdd::model()->findByPk($this->id);
        if (!$add) {
            $add = new ArticleAdd;
            $add->article_id = $this->id;
            $add->hits = 1;
            $add->save();
        }




//        //пингуем
//        include(Yii::getPathOfAlias('ext') . '/' . 'IXR_Library.php');
//        // Название сайта
//        $siteName = Yii::app()->name;
//        // Адрес сайта
//        $siteURL = Yii::app()->request->hostInfo . Yii::app()->request->requestUri;
//        // Адрес страницы, которая изменилась
//        $pageURL = Yii::app()->request->hostInfo . $this->link();
//        // Адрес страницы с фидом
//        $feedURL = Yii::app()->request->hostInfo . 'rss/';
//        // Яндекс.Блоги
//        $pingClient = new IXR_Client('ping.blogs.yandex.ru', '/RPC2');
//        $pingClient->query('weblogUpdates.ping', $siteName, $siteURL, $pageURL);
//
//        // Google блоги
//        $pingClient = new IXR_Client('blogsearch.google.com', '/ping/RPC2');
//        $pingClient->query('weblogUpdates.extendedPing', $siteName, $siteURL, $pageURL, $feedURL);

        file_get_contents('http://www.siapress.ru/cache.php');
        Yii::app()->cache->flush();

        return true;
    }

    public function generateImage($name = '') {
        $path = Yii::getPathOfAlias("webroot.images.news.main") . DIRECTORY_SEPARATOR;
        $pathtmp = Yii::getPathOfAlias("webroot.temp") . DIRECTORY_SEPARATOR;

        if (!empty($name))
            $this->image = $name;

        $img = new CImageHandler();
        if (!empty($name))
            $img->load($path . $this->image);
        else
            $img->load($pathtmp . $this->image);

        $img->resize(74, 109);
        $img->save($path . $this->id . '_home.jpg', IMG_JPEG, 80);
        $img->reload();

        $img->resize(300, 600);
        $img->save($path . $this->id . '_item.jpg', IMG_JPEG, 80);
        $img->reload();

        $img->resize(229, 600);
        $img->save($path . $this->id . '_main.jpg', IMG_JPEG, 80);
        $img->reload();

        $img->adaptiveThumb(118, 86);
        $img->save($path . $this->id . '_cat.jpg', IMG_JPEG, 80);
        $img->reload();

        if ($img->width > 1280) {
            $img->resize(1280, 1024);
            $img->save($path . $this->id . '.jpg', IMG_JPEG, 80);
        } elseif($img->width > 500) {
            $img->save($path . $this->id . '.jpg', IMG_JPEG, 80);
        }
    }

    public function image() {
        if ($this->id && is_file('images/news/main/' . $this->id . '_item.jpg')) {
            return CHtml::image('images/news/main/' . $this->id . '_item.jpg', $item->title);
        }
        return false;
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            $this->deleteImage(); // удалили модель? удаляем и файл
            return true;
        }
        return false;
    }

    public function deleteImage() {
        $path = Yii::getPathOfAlias("webroot.images.news.main") . DIRECTORY_SEPARATOR;
        $names = array('_main', '_item', '_home', '_cat', '');
        foreach ($names as $name) {
            if (is_file($path . $this->id . $name . '.jpg'))
                @unlink($path . $this->id . $name . '.jpg');
        }
    }

    public function getAuthor() {
        if ($this->author_alias)
            return $this->author_alias;
        else {
            if ($this->author0->perm_id == 2)
                return CHtml::link($this->author0->name . ' (СИА-ПРЕСС)', array('user/view', 'id' => $this->author));
        }
    }

    public function getImage($small = false, $id = 0) {
        $date = strtotime($this->created);
        if ($small) {
            $path = Yii::app()->getBaseUrl() . 'images/news/' . date('Y', $date) . '/' . date('m', $date) . '/' . date('d', $date) . '/' . $this->id . '.jpg';
            if (is_file($path))
                return CHtml::image($path, $this->title, array('class' => 'smalltitleimg'));
            else
                return false;
        }
        else {
            $path = Yii::app()->getBaseUrl() . 'images/news/' . date('Y', $date) . '/' . date('m', $date) . '/' . date('d', $date) . '/' . $this->id . '.jpg';
            if (is_file($path))
                return
                        CHtml::tag('div', array('class' => 'news-image-container'), CHtml::image($path, $this->title, array('class' => 'newsimage')) .
                                CHtml::tag('span', array('class' => 'imgtitle'), $this->imgtitle)
                );
            else
                return false;
        }
    }

    public function getMainItemId() {
        return $this->_mainId ? $this->_mainId : 0;
    }

    public function setMainItemId($id) {
        return $this->_mainId = $id;
    }

    /*
     * Получаем список всех доступных категорий
     */

    public function getAllcategories() {
        $categories = Yii::app()->cache->get('all_news_categories');
        if ($categories === false) {
            $query = "SELECT * FROM {{article_categories}} WHERE `published` = 1";
            $categories = Yii::app()->db->createCommand($query)->queryAll();
        }
        Yii::app()->cache->set('all_news_categories', $categories, 3600);
        #print_r($categories);
        #die();
        return $categories;
    }

    /*
     * Получаем одну категорию
     */

    public function getCategory($catid) {
        $categories = $this->getAllcategories();
        foreach ($categories as $cat) {
            if ($cat['alias'] == $catid)
                return $cat;
        }
        return false;
    }

    /*
     * получение только idкатегории
     */

    public function getCategoryId($catid) {
        $categories = $this->getAllcategories();
        foreach ($categories as $cat) {
            if ($cat['alias'] == $catid)
                return $cat['id'];
        }
        return false;
    }

    public function getCategoryAlias($catid) {
        $categories = $this->getAllcategories();
        foreach ($categories as $cat) {
            if ($cat['id'] == $catid)
                return $cat['alias'];
        }
        return false;
    }

    public function getCategoryFullname($catid) {
        $categories = $this->getAllcategories();
        foreach ($categories as $cat) {
            if ($cat['id'] == $catid)
                return $cat['fullname'];
        }
        return false;
    }

    public function getCategoryname($catid) {
        $categories = $this->getAllcategories();
        foreach ($categories as $cat) {
            if ($cat['id'] == $catid)
                return $cat['name'];
        }
        return false;
    }

    public function getCategorylink($catid) {
        $categories = $this->getAllcategories();
        foreach ($categories as $cat) {
            if ($cat['id'] == $catid)
                return $cat['name'];
        }
        return false;
    }

    public function getCountitems($catid) {
        #
        if (is_array($catid)) {
            $catid = implode(',', $catid);
            #die($catid);
        } elseif ($this->getCategoryId($catid)) {
            $catid = $this->getCategoryId($catid);
            #die($this->getCategoryId($catid););
        }
        else
            return false;

        $data = Yii::app()->cache->get(str_replace(',', '_', $catid) . '_count');
        if ($data === false) {
            $query = "SELECT COUNT(*) as count FROM {{articles}} WHERE `published` = 1 AND `cat_id` IN ($catid)";
            $data = Yii::app()->db->createCommand($query)->queryAll();
            $data = $data[0]['count'];
            Yii::app()->cache->set(str_replace(',', '_', $catid) . '_count', $data, Config::getCacheduration());
        }
        return $data;
    }

    /*
     * Получаем главную новость раздела
     */

    public function getMainitem($catid, $oncat = false) {
        #Yii::app()->cache->flush();
        $data = Yii::app()->cache->get($catid . '_main_index');

        if (is_array($catid)) {
            $cat = implode(',', $catid);
        } else
        if ($this->getCategoryId($catid)) {
            $cat = $this->getCategoryId($catid);
        }
        else
            return false;

        if ($data === false) {
            $main = ($oncat) ? '2' : '1';
            $query = "SELECT a.*, `add`.*, u.id as author,u.name as name, cat.id as cid, cat.alias as calias, cat.fullname as cfull,
                    (SELECT COUNT(*) FROM {{comments}} where published = 1 AND ban = 0 AND object_id = a.id AND object_type_id = 1) as comment_count
                    FROM {{articles}} as a
                    LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                    LEFT JOIN {{users}} as u ON a.author = u.id
                    LEFT JOIN {{article_categories}} as cat ON a.cat_id = cat.id
                    WHERE a.cat_id IN ($cat)
                    AND a.publish <= NOW()
                    AND a.main = 1
                    ORDER BY a.created DESC
                    LIMIT 1";
            $data = Yii::app()->db->createCommand($query)->queryAll();
            if ($data === null)
                return false;
            else
                $data = $data[0];
            Yii::app()->cache->set($catid . '_main_index', $data, Config::getCacheduration());

            Yii::trace("Получаем главную новость НЕ из кэша!");
        } else
            Yii::trace("Получаем главную новость из кэша!");

        if ($data['id'])
            $this->setMainItemId($data['id']);

        return $data;
    }

    /*
     * получаем статьи
     */

    public function getItems($catid, $limit = 15, $page = 0) {

        $data = Yii::app()->cache->get($catid . '_index_' . $page . '_' . $limit);

        if (is_array($catid)) {
            $cat = implode(',', $catid);
        } elseif ($this->getCategoryId($catid)) {
            $cat = $this->getCategoryId($catid);
            #die($this->getCategoryId($catid););
        }
        else
            return false;

        if ($page)
            $limit = $page * $limit - $limit . ', ' . $limit;

        if ($data === false) {
            $query = "SELECT a.*, `add`.*, u.id as author,u.name as name, c.fullname, c.name as cname, c.alias,
                     (SELECT COUNT(*) FROM {{comments}} where published = 1 AND ban = 0 AND object_id = a.id AND object_type_id = 1) as comment_count
                     FROM {{articles}} as a
                     LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                     LEFT JOIN {{users}} as u ON a.author = u.id
                     LEFT JOIN {{article_categories}} as c ON a.cat_id = c.id
                     WHERE a.cat_id IN ($cat)
            AND a.publish <= NOW()
                     AND a.id != " . $this->getMainItemId() . "
                     AND a.published = 1
                     ORDER BY a.publish DESC
                     LIMIT $limit";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            Yii::app()->cache->set($catid . '_index_' . $page, $data, Config::getCacheduration());

            Yii::trace("Получаем список новостей категории $catid НЕ из кэша!");
        } else
            Yii::trace("Получаем список новостей категории $catid из кэша!");

        return $data;
    }

    public function getBlogs($limit = 4) {

        $data = Yii::app()->cache->get('bloggers' . $limit);

        if ($data === false) {
            $query = "SELECT a.*, `add`.*, u.id as author,u.name as name,
                     (SELECT COUNT(*) FROM {{comments}} where published = 1 AND ban = 0 AND object_id = a.id AND object_type_id = 1) as comment_count
                     FROM {{articles}} as a
                     LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                     LEFT JOIN {{users}} as u ON a.author = u.id
                     WHERE a.cat_id in(9)
                     AND a.published = 1
                    AND a.publish <= NOW()
                    AND `top` = 1
                     ORDER BY a.publish DESC
                     LIMIT $limit";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            Yii::app()->cache->set('bloggers' . $limit, $data, Config::getCacheduration());
        }

        return $data;
    }

    public function getRss($limit = 50, $blogs = false) {

        $data = Yii::app()->cache->get('RSS');
        if ($blogs) {
            $b = '';
        } else {
            $b = 'a.cat_id != 8 AND a.cat_id != 9
                     AND';
        }
        if ($data === false) {
            $query = "SELECT a.*, `add`.*, u.id as author,u.name as name, cat.name as catname
                     FROM {{articles}} as a
                     LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                     LEFT JOIN {{users}} as u ON a.author = u.id
            LEFT JOIN {{article_categories}} as cat on a.cat_id = cat.id
                     WHERE $b a.published = 1
                        AND a.publish <= NOW()
                     ORDER BY a.publish DESC
                     LIMIT $limit";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            Yii::app()->cache->set('RSS', $data, Config::getCacheduration());

            Yii::trace("Получаем список новостей категории $catid НЕ из кэша!");
        } else
            Yii::trace("Получаем список новостей категории $catid из кэша!");

        return $data;
    }

    public function getPopularitems($limit = 10) {

        $data = Yii::app()->cache->get('mainpopular');

        if ($data === false) {
            $query = "SELECT a.*, `add`.*
                     #(SELECT COUNT(*) FROM {{comments}} where published = 1 AND ban = 0 AND object_id = a.id AND object_type_id = 1) as comment_count
                     FROM {{articles}} as a
                     LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                     WHERE
                     a.created > ADDDATE(NOW(), INTERVAL '-7' DAY) and a.publish > ADDDATE(NOW(), INTERVAL '-7' DAY)
                     AND
                     a.published = 1
                    AND a.publish <= NOW()
                     ORDER BY add.hits desc
                     #AND cat_id != 9 AND cat_id != 8
                     LIMIT $limit";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            Yii::app()->cache->set('mainpopular', $data, Config::getCacheduration());
        }

        return $data;
    }

    /*
     * Поиск статьи по id
     */

    public function findArticle($id) {
        $data = Yii::app()->cache->get('article_' . intval($id));
        if ($data === false) {
            $query = "SELECT a.*, `add`.*, u.id as author,u.name as name, u.perm_id,
                    (SELECT COUNT(*) FROM {{comments}} where published = 1 AND ban = 0 AND object_id = a.id AND object_type_id = 1) as comment_count
                    FROM {{articles}} as a
                    LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                    LEFT JOIN {{users}} as u ON a.author = u.id
                    WHERE a.published = 1
                    AND a.publish <= NOW()
                    AND a.id = " . intval($id) . "
                    LIMIT 1";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            #print_r($data);die();
            Yii::app()->cache->set('article_' . intval($id), $data, Config::getCacheduration());
        }
//        $add = ArticleAdd::model()->findByPk($id);
//        if ($add) {
//            $add->hits++;
//            $add->save();
//        }
        #Yii::app()->db->createCommand('UPDATE sia_article_add SET hits =  hits + 1 WHERE article_id = ' . $id)->execute();

        if (empty($data))
            return false;
        else
            return $data[0];
    }

    public function getArticleimage($model) {
        $date = strtotime($model['created']);

        $img = Yii::app()->getBaseUrl() . 'images/news/main/' . $model['id'] . '_item.jpg';
        if (is_file($img) AND !empty($model['imgtitle']))
            return CHtml::tag('div', array('class' => 'news-image-container'), CHtml::image($img, $model['title'], array('class' => 'newsimage')) .
                            CHtml::tag('span', array('class' => 'imgtitle'), $model['imgtitle']));
        else
        if (is_file($img))
            return CHtml::tag('div', array('class' => 'news-image-container'), CHtml::image($img, $model['title'], array('class' => 'newsimage')));
        else
            return false;
    }

    public function getArticleauthor($model) {
        if ($model['author_alias'])
            return $model['author_alias'];
        else {
            if ($model['perm_id'] == 2)
                return $model['name'] . ' (СИА-ПРЕСС)';
            else
                return $model['name'];
            //Раскоментить если нужны ссылки на авторов
            //return CHtml::link($model['name'] . ' (СИА-ПРЕСС)', array('user/view', 'id' => $model['author']));
        }
    }

    /*
     * Получение голой ссылки новости
     */

    public function getArticlestriplink($model) {
        #CVarDumper::dump($model);
        return Yii::app()->createUrl('news/' . $this->getCategoryAlias($model['cat_id']) . '/' . $model['id']);
    }

    public function link($absolute = false) {
        if ($this->cat_id == 9)
            return $absolute ? Yii::app()->createAbsoluteUrl('blogs/' . $this->id) : Yii::app()->createUrl('blogs/' . $this->id);
        elseif ($this->cat_id == 8)
            return $absolute ? Yii::app()->createAbsoluteUrl('opinion/' . $this->id) : Yii::app()->createUrl('opinion/' . $this->id);
        else
            return $absolute ? Yii::app()->createAbsoluteUrl('news/' . $this->getCategoryAlias($this->cat_id) . '/' . $this->id) : Yii::app()->createUrl('news/' . $this->getCategoryAlias($this->cat_id) . '/' . $this->id);
    }

    public function blogs($limit = 10) {
        $this->getDbCriteria()->mergeWith(array(
            'order' => 'created DESC',
            'limit' => $limit,
        ));
        return $this;
    }

    public function getImgpath($id, $date = false, $img = false, $html = false, $type = '') {
        $date = strtotime($date);
        $path = Yii::app()->getBaseUrl() . 'images/news/main/';
        if ($img) {
            $path .= $id . $type . '.jpg';
            if (!is_file($path))
                return false;
        }

        if ($html)
            return CHtml::image($path, ' ');
        else
            return $path;
    }

    public function getPhotos($id) {
        $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                . 'images' . DIRECTORY_SEPARATOR . 'galleries' . DIRECTORY_SEPARATOR . $id;
        $prev = $path . DIRECTORY_SEPARATOR . 'prev';
        $p = 'images/galleries/' . $id . '/';

        if (is_dir($path)) {
            $files = CFileHelper::findFiles($path, array(
                        'fileTypes' => array('jpg'),
                        'level' => 0,
                    ));
            $f = array();
            $f2 = array();
            foreach ($files as $file) {
                $f[] = $p . basename($file);
                $f2[] = $p . 'prev/' . basename($file);
            }
            return array($f, $f2);
        } else
            return false;
    }

    public function getNewscat() {
        return array(1, 2, 3, 4, 5, 6, 7, 15);
    }

    public function getMeta($loadmodel) {
        include Yii::app()->basePath . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'phpmorphy' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'common.php';
        $dir = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'phpmorphy' . DIRECTORY_SEPARATOR . 'dicts';
        $lang = 'ru_RU';
        $opts = array('storage' => PHPMORPHY_STORAGE_FILE,);
        try {
            $morphy = new phpMorphy($dir, $lang, $opts);
        } catch (phpMorphy_Exception $e) {
            die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
        }
        $content = strip_tags($loadmodel['fulltext']);

        $stemword = array();
        $wordcount = array();
        $word_pma = array();
        $words = array();
        $content = mb_strtoupper(str_ireplace("ё", "е", $content), "UTF-8");

        preg_match_all('/([a-zа-яё]+)/ui', $content, $word_pma);

        $words = $morphy->lemmatize($word_pma [1], phpMorphy::NORMAL);
        foreach ($words as $k => $w) {
            if (!$w)
                $w [0] = $k;
            if (mb_strlen($w [0], "UTF-8") > 2) {
                if (!isset($word [$w [0]])) {
                    $word [$w [0]] = 0;
                }
                $word [$w [0]] += 1;
            }
        }


        if (count($word) != 0) {
            arsort($word);
        } else {
            return '';
        }
        $keywords = array();
        $it = 0;
        $return = array();
        foreach ($word as $val => $key) {
            $info = $morphy->getPartOfSpeech($val);
            if ($word[$val] > 1) {
                if ($info[0] == "С") {
                    $keywords[$it] = $val;
                    $it++;
                }
            } else {
                //break;
            }
        }
        for ($it = 0; $it < min(15, count($keywords)); $it++) {
            $return[] = mb_strtolower($keywords[$it], 'UTF-8');
        }
        return implode(', ', $return);
    }

}