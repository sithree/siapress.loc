<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property integer $id
 * @property string $text
 * @property integer $author_id
 * @property string $name
 * @property string $email
 * @property string $ip
 * @property integer $published
 * @property string $created
 * @property integer $modif_com_id
 * @property integer $object_type_id
 * @property integer $object_id
 * @property integer $parent
 * @property integer $level
 *
 * The followings are the available model relations:
 * @property Users $author
 * @property ObjectTypes $objectType
 * @property CommentsAdd $commentsAdd
 */
class Comment extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{comments}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('text, author_id, name, email, ip, object_type_id, object_id', 'required'),
            array('author_id, published, modif_com_id, object_type_id, object_id, parent, level', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('email', 'length', 'max' => 50),
            array('ip', 'length', 'max' => 15),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, text, author_id, name, email, ip, published, created, modif_com_id, object_type_id, object_id, parent, level', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'author' => array(self::BELONGS_TO, 'Users', 'author_id'),
            'article' => array(self::BELONGS_TO, 'Article', 'object_id'),
            'objectType' => array(self::BELONGS_TO, 'ObjectTypes', 'object_type_id'),
            'commentsAdd' => array(self::HAS_ONE, 'CommentsAdd', 'comment_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'text' => 'Text',
            'author_id' => 'Author',
            'name' => 'Name',
            'email' => 'Email',
            'ip' => 'Ip',
            'published' => 'Published',
            'created' => 'Created',
            'modif_com_id' => 'Modif Com',
            'object_type_id' => 'Object Type',
            'object_id' => 'Object',
            'parent' => 'Parent',
            'level' => 'Level',
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
        $criteria->compare('text', $this->text, true);
        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('ip', $this->ip, true);
        $criteria->compare('published', $this->published);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modif_com_id', $this->modif_com_id);
        $criteria->compare('object_type_id', $this->object_type_id);
        $criteria->compare('object_id', $this->object_id);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('level', $this->level);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function afterSave() {
        if ($this->isNewRecord) {
            $name = '=?UTF-8?B?' . base64_encode("Сиа-пресс") . '?=';
            $subject = '=?UTF-8?B?' . base64_encode("Добавлен новый комментарий") . '?=';
            $headers = "From: $name <no-reply@siapress.ru>\r\n" .
                    "Reply-To: no-reply@siapress.ru\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-type: text/html; charset=UTF-8";

            $controller = new Controller('CommentController');

            $text = $controller->renderPartial('application.views.front.comments._mail_form', array('model' => $this), true);

            mail(Yii::app()->params['adminEmail'] .', siapress@mail.ru', $subject, $text, $headers);
        }
        return true;
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->token = md5(md5(md5($this->object_id . $this->created . $this->author_id . $this->email . $this->name)));
            return true;
        }
    }

    public function getAllComments($id, $type = 1) {
        #Yii::app()->cache->flush();
        $comments = Yii::app()->cache->get('comment_news_1' . $id);
        if ($comments === false) {
            $query = "SELECT c.*, `add`.*, u.username as uname, u.login_from, u.id as userid FROM {{comments}} as c
                      LEFT JOIN {{comments_add}} as `add` ON c.id = `add`.comment_id
                      LEFT JOIN {{users}} as u ON c.author_id = u.id
                      WHERE c.object_id = $id
                      AND c.object_type_id = $type
                      #AND published = 1
                      #AND parent = 0
                      ORDER BY created, path  ASC";
            $comments = Yii::app()->db->createCommand($query)->queryAll();
        }
        Yii::app()->cache->set('comment_news_' . $id, $comments, Config::getCacheduration());
        return $comments;
    }

    /*
     * Фукция обработки комментов
     *
     */

    public function replace($str) {
        #return $str;


        $patterns = array();
        $replacements = array();

        //BR
        $patterns[] = "#\r#";
        $replacements[] = '<br />';

        //:-)
        $patterns[] = "#\:\-\)#";
        $replacements[] = '<img src="images/smiles/smile.gif" />';
        //:)
        $patterns[] = "#\:\)#";
        $replacements[] = '<img src="images/smiles/smile.gif" />';
        //:D
        $patterns[] = "#\:D#";
        $replacements[] = '<img src="images/smiles/lol.gif" />';
        //:-D
        $patterns[] = "#\:\-D#";
        $replacements[] = '<img src="images/smiles/lol.gif" />';
        //:-(
        $patterns[] = "#\:\-\(#";
        $replacements[] = '<img src="images/smiles/sad.gif" />';
        //:'-(
        $patterns[] = "#\:\'\-\(#";
        $replacements[] = '<img src="images/smiles/cry.gif" />';
        //:-Р
        $patterns[] = "#\:\-P#";
        $replacements[] = '<img src="images/smiles/tongue.gif" />';


        // B
        $patterns[] = '/\[b\](.*?)\[\/b\]/iu';
        $replacements[] = '<b>\\1</b>';

        // I
        $patterns[] = '/\[i\](.*?)\[\/i\]/iu';
        $replacements[] = '<i>\\1</i>';

        // U
        $patterns[] = '/\[u\](.*?)\[\/u\]/iu';
        $replacements[] = '<u>\\1</u>';

        // S
        $patterns[] = '/\[s\](.*?)\[\/s\]/iu';
        $replacements[] = '<strike>\\1</strike>';

        // SUP
        $patterns[] = '/\[sup\](.*?)\[\/sup\]/iu';
        $replacements[] = '<sup>\\1</sup>';

        // SUB
        $patterns[] = '/\[sub\](.*?)\[\/sub\]/iu';
        $replacements[] = '<sub>\\1</sub>';

        // URL (local)
        $liveSite = Yii::app()->baseUrl;

        $patterns[] = '#\[url\](' . preg_quote($liveSite, '#') . '[^\s<\"\']*?)\[\/url\]#iu';
        $replacements[] = '<a href="\\1" target="_blank">\\1</a>';

        $patterns[] = '#\[url=(' . preg_quote($liveSite, '#') . '[^\s<\"\'\]]*?)\](.*?)\[\/url\]#iu';
        $replacements[] = '<a href="\\1" target="_blank">\\2</a>';

        $patterns[] = '/\[url=(\#|\/)([^\s<\"\'\]]*?)\](.*?)\[\/url\]/iu';
        $replacements[] = '<a href="\\1\\2" target="_blank">\\3</a>';

        // URL (external)
        $patterns[] = '#\[url\](http:\/\/)?([^\s<\"\']*?)\[\/url\]#iu';
        $replacements[] = '<a href="http://\\2" rel="external nofollow" target="_blank">\\2</a>';

        $patterns[] = '/\[url=([a-z]*\:\/\/)([^\s<\"\'\]]*?)\](.*?)\[\/url\]/iu';
        $replacements[] = '<a href="\\1\\2" rel="external nofollow" target="_blank">\\3</a>';

        $patterns[] = '/\[url=([^\s<\"\'\]]*?)\](.*?)\[\/url\]/iu';
        $replacements[] = '<a href="http://\\1" rel="external nofollow" target="_blank">\\2</a>';

        $patterns[] = '#\[url\](.*?)\[\/url\]#iu';
        $replacements[] = '\\1';

        // EMAIL
        $patterns[] = '#\[email\]([^\s\<\>\(\)\"\'\[\]]*?)\[\/email\]#iu';
        $replacements[] = '\\1';

        // IMG
        $patterns[] = '#\[img\](http:\/\/)?([^\s\<\>\(\)\"\']*?)\[\/img\]#iu';
        $replacements[] = '<img class="img" src="http://\\2" alt="" border="0" />';

        $patterns[] = '#\[img\](.*?)\[\/img\]#iu';
        $replacements[] = '\\1';

        $str = preg_replace($patterns, $replacements, $str);

        //QUOTE
        $quotePattern = '#\[quote\s?name=\"([^\"\'\<\>\(\)]+)+\"\](<br\s?\/?\>)*(.*?)(<br\s?\/?\>)*\[\/quote\]#iu';
        $quoteReplace = '<span class="quote2">Цитирую: \\1</span><blockquote>\\3</blockquote>';
        while (preg_match($quotePattern, $str)) {
            $str = preg_replace($quotePattern, $quoteReplace, $str);
        }
        $quotePattern = '#\[quote[^\]]*?\](<br\s?\/?\>)*([^\[]+)(<br\s?\/?\>)*\[\/quote\]#iu';
        $quoteReplace = '<span class="quote">Цитата:</span><blockquote>\\2</blockquote>';
        while (preg_match($quotePattern, $str)) {
            $str = preg_replace($quotePattern, $quoteReplace, $str);
        }

        return $str;
    }

    public function getLastcomments($catid = array(), $page = 0, $limit = 10) {
        $data = Yii::app()->cache->get('last_comment_page_' . $page);
        $cat = implode(',', $catid);

        if ($page)
            $limit = $page * $limit - $limit . ', ' . $limit;

        if ($data === false) {
            $query = "SELECT c.id as cid, c.text, c.`name`,c.created, c.author_id, a.id, a.cat_id, u.id as uid, u.`name` as username, u.username as login,
                a.title, a.cat_id
                   FROM {{comments}} as c
                    LEFT JOIN {{articles}} as a on c.object_id = a.id
                    LEFT JOIN {{users}} as u on c.author_id = u.id
                    WHERE
                    a.cat_id IN ($cat)
                    AND c.ban = 0 AND c.published = 1
                    ORDER BY c.created DESC LIMIT $limit";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            Yii::app()->cache->set('last_comment_page_' . $page, $data, Config::getCacheduration());

            Yii::trace("Получаем список новостей категории $catid НЕ из кэша!");
        } else
            Yii::trace("Получаем список новостей категории $catid из кэша!");

        return $data;
    }

    public function getPopularcomments($catid = array(), $page = 0, $limit = 10) {
        $data = Yii::app()->cache->get('popular_comment_page_' . $page);
        $cat = implode(',', $catid);

        if ($page)
            $limit = $page * $limit - $limit . ', ' . $limit;

        if ($data === false) {
            $query = "SELECT a.*, `add`.*,
                (SELECT COUNT(*) FROM {{comments}} where object_id = a.id) as count
                FROM {{articles}} as a
            LEFT JOIN {{article_add}} as `add` ON a.id = `add`.article_id
                LEFT JOIN {{comments}} as c ON a.id = c.object_id
                WHERE a.created > ADDDATE(NOW(), INTERVAL '-7' DAY) and a.publish > ADDDATE(NOW(), INTERVAL '-7' DAY)
            GROUP BY a.id
                ORDER BY `count`  desc
                LIMIT $limit;";
            #die($query);
            $data = Yii::app()->db->createCommand($query)->queryAll();
            Yii::app()->cache->set('popular_comment_page_' . $page, $data, Config::getCacheduration());

            Yii::trace("Получаем список новостей категории $catid НЕ из кэша!");
        } else
            Yii::trace("Получаем список новостей категории $catid из кэша!");

        return $data;
    }

}

