<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CommentForm extends CFormModel {

    public $username;
    public $email;
    public $capcha;
    public $text;
    public $object_id;
    public $object_type_id;
    public $author_id;
    public $ip;
    public $created;
    public $parent;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('username, text', 'required', 'message' => 'Введите <b>«{attribute}»</b>'),
            array('ip', 'ban'),
            /* array('capcha', 'myCaptcha', 'captchaAction'=>'site/captcha',
              'message' => Yii::t('user', 'Неверный проверочный код'), 'allowEmpty' => !Yii::app()->user->isGuest || !extension_loaded('gd')),

             */
            array('parent','safe'),
            array(
                'capcha',
                'captcha',
                // авторизованным пользователям код можно не вводить
                'allowEmpty' => !Yii::app()->user->isGuest || !extension_loaded('gd')
            ),
            array('text', 'length', 'max' => 4000, 'min' => 3)
                // password needs to be authenticated
                #array('password', 'authenticate'),
        );
    }

    public function ban($attribute, $params) {
        $ban = array('109.167.200.255');
        
        if (in_array(Yii::app()->request->getUserHostAddress(), $ban))
            $this->addError('username', 'Ваш IP заблокирован. Вы не можете оставлять комментарии.');
    }

    public function myCaptcha($attr, $params) {
        if (Yii::app()->request->isAjaxRequest)
            return;

        CValidator::createValidator('captcha', $this, $attr, $params)->validate($this);
    }

    public function beforeValidate() {
        if (!Yii::app()->user->isGuest) {
            $user = Users::model()->findByPk(Yii::app()->user->id);
            if ($user) {
                $this->email = $user->email ? $user->email : 'NOEMAIL';
                $this->username = $user->name ? $user->name : $user->username;
                $this->author_id = $user->id;
            }
        } else {
            $this->author_id = 0;
            $this->email = 'NOEMAIL';
        }
        $event = new CModelEvent($this);
        $this->onBeforeValidate($event);
        return $event->isValid;
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'Имя',
            'email' => 'Email',
            'capcha' => 'Код с картинки',
            'text' => 'Текст комментария',
            'Ssubmit' => 'Отправить'
        );
    }

}
