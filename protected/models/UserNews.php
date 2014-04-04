<?php

/**
 * This is the model class for table "{{user_news}}".
 *
 * The followings are the available columns in table '{{user_news}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_phone
 * @property string $title
 * @property string $fulltext
 * @property string $link
 */
class UserNews extends CActiveRecord {

    public $captcha;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user_news}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array((Yii::app()->user->isGuest ? 'user_name, user_email, ' : '') . 'title, fulltext', 'required', 'message' => 'необходимо заполнить.'),
            array('captcha', 'captcha', 'allowEmpty' => !Yii::app()->user->isGuest || !extension_loaded('gd'), 'message' => 'не верный текст'),
            array('user_name, user_email, title, link', 'length', 'max' => 255),
            array('user_phone', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, user_name, user_email, user_phone, title, fulltext, link', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User_id',
            'user_name' => 'Имя пользователя',
            'user_email' => 'E-mail',
            'user_phone' => 'Номер телефона',
            'title' => 'Заголовок',
            'fulltext' => 'Текст',
            'link' => 'Ссылка',
            'captcha' => 'Текст с картинки'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_email', $this->user_email, true);
        $criteria->compare('user_phone', $this->user_phone, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('fulltext', $this->fulltext, true);
        $criteria->compare('link', $this->link, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function afterSave() {
        if ($this->isNewRecord) {
            $name = '=?UTF-8?B?' . base64_encode("Сиа-пресс") . '?=';
            $subject = '=?UTF-8?B?' . base64_encode("Добавлена новая новость") . '?=';
            $headers = "From: $name <no-reply@siapress.ru>\r\n" .
                    "Reply-To: no-reply@siapress.ru\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-type: text/html; charset=UTF-8";

            $controller = new Controller('UserNewsController');

            $text = $controller->renderPartial('application.views.front.userNews._mail_form', array('model' => $this), true);

            mail('post@siapress.ru', $subject, $text, $headers);
        }
        return true;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserNews the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
