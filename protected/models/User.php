<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $email
 * @property integer $active
 * @property integer $vk_id
 * @property integer $tw_id
 * @property integer $fb_id
 * @property integer $login_from
 * @property integer $perm_id
 * @property string $last_visit
 * @property string $register_date
 * @property integer $block
 *
 * The followings are the available model relations:
 * @property Articles[] $siaArticles
 * @property Articles[] $articles
 * @property Comments[] $comments
 * @property CommentsAdd[] $commentsAdds
 * @property UserAdd $userAdd
 * @property UserPermiss $perm
 * @property UserLoginFrom $loginFrom
 */
class User extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, name, vk_id, tw_id, fb_id, last_visit, register_date', 'required'),
            array('active, vk_id, tw_id, fb_id, login_from, perm_id, block', 'numerical', 'integerOnly' => true),
            array('username, name, email', 'length', 'max' => 100),
            array('password', 'length', 'max' => 34),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, name, password, email, active, vk_id, tw_id, fb_id, login_from, perm_id, last_visit, register_date, block', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'siaArticles' => array(self::MANY_MANY, 'Articles', '{{article_users}}(user_id, article_id)'),
            'articles' => array(self::HAS_MANY, 'Articles', 'author'),
            'comments' => array(self::HAS_MANY, 'Comments', 'author_id'),
            'commentsAdds' => array(self::HAS_MANY, 'CommentsAdd', 'user_id'),
            'userAdd' => array(self::HAS_ONE, 'UserAdd', 'user_id'),
            'perm' => array(self::BELONGS_TO, 'UserPermiss', 'perm_id'),
            'loginFrom' => array(self::BELONGS_TO, 'UserLoginFrom', 'login_from'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'password' => 'Password',
            'email' => 'Email',
            'active' => 'Active',
            'vk_id' => 'Vk',
            'tw_id' => 'Tw',
            'fb_id' => 'Fb',
            'login_from' => 'Login From',
            'perm_id' => 'Perm',
            'last_visit' => 'Last Visit',
            'register_date' => 'Register Date',
            'block' => 'Block',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('vk_id', $this->vk_id);
        $criteria->compare('tw_id', $this->tw_id);
        $criteria->compare('fb_id', $this->fb_id);
        $criteria->compare('login_from', $this->login_from);
        $criteria->compare('perm_id', $this->perm_id);
        $criteria->compare('last_visit', $this->last_visit, true);
        $criteria->compare('register_date', $this->register_date, true);
        $criteria->compare('block', $this->block);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getAuthoravatar($id, $blog = true)
    {
        if ($blog)
        {
            return Yii::app()->createAbsoluteUrl('images/users/blog/' . $id . '.jpg');
        } else
        {
            return Yii::app()->createAbsoluteUrl('images/users/ava/' . $id . '.jpg');
        }
    }

    public static function isBaned()
    {
        $ip = Yii::app()->request->userHostAddress;
        $date = date('Y-m-d H:i:s');
        return (bool) count(BanItem::model()->findAll("ip='{$ip}' AND date>'{$date}'"));
    }

    public static function ban($date, $ip = '', $user_id = 0)
    {
        if (!$ip)
            $ip = Yii::app()->request->userHostAddress;
        $ban = BanItem::model()->find("ip = '{$ip}' AND $user_id = '{$user_id}'");
        if (!$ban)
            $ban = new BanItem();
        $ban->user_id = $user_id;
        $ban->ip = $ip;
        $ban->date = $date;
        $ban->save();
    }

}
