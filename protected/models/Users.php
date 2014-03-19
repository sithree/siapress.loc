<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $email
 * @property integer $active
 * @property integer $vk_id
 * @property integer $fb_id
 * @property integer $login_from
 * @property integer $perm_id
 * @property string $last_visit
 * @property string $register_date
 *
 * The followings are the available model relations:
 * @property Articles[] $siaArticles
 * @property Articles[] $articles
 * @property Comments[] $comments
 * @property CommentsAdd[] $commentsAdds
 * @property UserPermiss $perm
 * @property UserLoginFrom $loginFrom
 */
require_once('phpass/PasswordHash.php');

class Users extends CActiveRecord {

    /**
     * Возвращает true или false в зависимости от того, прошла ли проверка пароля
     * @return boolean
     */
    public function validatePassword($password) {
        $passwordhash = new PasswordHash(8, FALSE);
        return $passwordhash->CheckPassword($password, $this->password);
    }

    public function hashPassword($password) {
        $passwordhash = new PasswordHash(8, FALSE);
        return $passwordhash->HashPassword($password);
    }

    /**
     *
     * @return type boolean
     * Возвращает правду если пользователь есть в базе
     * в авторизуемой социальной сети
     */
    public function checkSocial($id = EAuthUserIdentity) {
        if ($id->getState('service') == 'vkontakte') {
            return $id->getState('serviceid') ? $vk_id = $this->find('vk_id=?', array($id->getState('serviceid'))) : '';
        } else
        if ($id->getState('service') == 'facebook') {
            return $fb_id = $this->find('fb_id=?', array($id->getState('serviceid')));
        }
        return false;
    }

    public function scopes() {
        return array(
            'author' => array(
                'order' => 't.perm_id, t.`name`',
                'condition' => 't.perm_id in(1,2,3,6) and t.active = 1',
                'with' => 'perm'
            ),
        );
    }

    /**
     * Создает нового пользователя на основе данных
     * из социальных сетей
     * @param type $id - данные авторизации
     * @return type boolean - успешно или нет
     */
    public function createSocialUser($id = EAuthUserIdentity) {
        $new = new Users;
        $new->setAttributes(array(
            'name' => $id->getState('name'),
            'vk_id' => $id->getState('id'),
            'login_from' => 2,
            'perm_id' => 5,
            'register_date' => new CDbExpression('NOW()'),
            'last_visit' => new CDbExpression('NOW()'),
        ));
        $new->save();

        // Добавляем дополнительные данные
        $add = new UserAdd;
        $add->user_id = $new->id;
        $add->sex = $id->getState('sex');
        $add->birdthday = date('Y-m-d', strtotime($id->getState('bdate')));
        $add->country = $id->getState('country');
        $add->city = $id->getState('city');
        $add->save();

        return ($new->id) ? true : false;
    }

    /**
     * Создает нового пользователя на основе данных
     * из социальных сетей
     * @param type $id - данные авторизации
     * @return type boolean - успешно или нет
     */
    public function getUserid($id, $name) {
        $soc = array('vkontakte' => 'vk_id', 'facebook' => 'fb_id', 'twitter' => 'tw_id');
        $user = User::model()->find($soc[$name] . ' = ' . $id);
        return $user->id;
    }

    public function getAvaPath($type = '') {
        return 'images/users/ava/' . md5($this->id . $type . '+salt+') . '.jpg';
    }

    public function getUserava($userid, $html = false) {
        #echo $userid . '---';

        if ($userid == "0")
            return $html ? 'images/users/noava.jpg' : '<img src="images/users/noava.jpg" alt="Без аватарки"/>';
        else {
            $userpath = 'images/users/ava/' . $userid . '.jpg';
            if (is_file($userpath)) {
                return $html ? $userpath : "<img src='$userpath' alt='' />";
            } else
                return $html ? 'images/users/noava.jpg' : '<img src="images/users/noava.jpg" alt="Без аватарки"/>';
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username', 'testLogin', 'on' => 'newUser'),
            array('username,firstname, lastname, last_visit, register_date', 'required'),
            array('active, vk_id, fb_id, login_from, perm_id, block, caption, moderation', 'numerical', 'integerOnly' => true),
            array('name, email, username, firstname, lastname,middlename,address,phone, caption_text', 'length', 'max' => 100),
            array('password', 'length', 'max' => 60),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, password, email, active, vk_id, fb_id, login_from, perm_id, last_visit', 'safe', 'on' => 'search'),
        );
    }

    public function testlogin($attribute, $params) {
        $l = Users::model()->find('username = "' . $this->username . '"');
        if ($l) {
            $this->addError('username', 'Такой псевдоним уже используется. Попробуйте другой.');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'siaArticles' => array(self::MANY_MANY, 'Articles', '{{article_users}}(user_id, article_id)'),
            'articles' => array(self::HAS_MANY, 'Articles', 'modified_id'),
            'comments' => array(self::HAS_MANY, 'Comments', 'author_id'),
            'commentsAdds' => array(self::HAS_MANY, 'CommentsAdd', 'user_id'),
            'perm' => array(self::BELONGS_TO, 'UserPermiss', 'perm_id'),
            'loginFrom' => array(self::BELONGS_TO, 'UserLoginFrom', 'login_from'),
            'Add' => array(self::HAS_ONE, 'UserAdd', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Имя Фамилия',
            'username' => 'Логин',
            'password' => 'Пароль',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'middlename' => 'Отчетсво',
            'caption_text' => 'Должность',
            'caption' => 'Показ. должность',
            'email' => 'Email',
            'block' => 'Блокирован',
            'status' => 'Статус',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'occupation' => 'Род занятий',
            'about' => 'О себе',
            'active' => 'Включен',
            'vk_id' => 'Vk',
            'fb_id' => 'Fb',
            'moderation' => 'Промодерирован',
            'login_from' => 'Login From',
            'perm_id' => 'Группа',
            'last_visit' => 'Last Visit',
            'register_date' => 'Дата регистрации'
        );
    }

    public function beforeSave() {
        parent::beforeSave();
        $this->name = $this->firstname . ' ' . $this->lastname;

        if ($this->isNewRecord) {
            $this->password = $this->hashPassword($this->password);
            !$this->email ? $this->email = "0" : '';
            !$this->vk_id ? $this->vk_id = "0" : '';
            !$this->fb_id ? $this->fb_id = "0" : '';
            !$this->tw_id ? $this->tw_id = "0" : '';
        }

        return true;
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('vk_id', $this->vk_id);
        $criteria->compare('fb_id', $this->fb_id);
        $criteria->compare('login_from', $this->login_from);
        $criteria->compare('perm_id', $this->perm_id);
        $criteria->compare('last_visit', $this->last_visit, true);
        $criteria->compare('register_date', $this->register_date, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function setAvatar($avatar, $x = false, $y = false, $type) {
        $tmp = $this->getTmpPath();
        #die($avatar);
        if ($x) {
            $img = new CImageHandler();
            $img->load($avatar);
            $img->thumb($x, $y);
            $img->save($this->getAvatarFilename($type, true), IMG_JPEG, 80);
            return;
        }

        if (is_file($tmp . $avatar)) {
            $img = new CImageHandler();
            $path = Yii::getPathOfAlias('webroot.images.users.ava') . DIRECTORY_SEPARATOR;
            //50x50 маленькая аватарка
            $img->load($tmp . $avatar);
            $img->thumb(50, 50);
            $img->save($this->getAvatarFilename('50', true), IMG_JPEG, 80);

            //Для страницы просмотра компании
            $img->reload();
            $img->resize(200, false);
            $img->save($this->getAvatarFilename('200', true), IMG_JPEG, 80);

            //Оригинальный файл
            $img->reload();
            $img->save($this->getAvatarFilename('', true), IMG_JPEG, 80);

            //Удаляем временный файл
            @unlink($tmp . $avatar);
        }
    }

    public function getAvatarPath() {
        return Yii::getPathOfAlias('webroot.images.users.ava') . DIRECTORY_SEPARATOR;
    }

    public function getTmpPath() {
        return Yii::getPathOfAlias('webroot.temp') . DIRECTORY_SEPARATOR;
    }

    public function getAvatar($type = '') {
        return is_file($this->getAvatarFilename($type)) ? $this->getAvatarFilename($type) : false;
    }

    public function getAvatarFilename($type = '', $t = false, $id = 0) {
        if ($id === 0)
            $id = $this->id;
        if (is_file('images/users/ava/' . md5($id . $type . '+salt+') . '.jpg') && $t == false) {
            return 'images/users/ava/' . md5($id . $type . '+salt+') . '.jpg';
        } elseif ($t == false)
            return 'images/users/noava.jpg';
        else
            return $this->getAvatarPath() . md5($id . $type . '+salt+') . '.jpg';
    }

}