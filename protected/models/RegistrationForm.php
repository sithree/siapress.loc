<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegistrationForm extends CFormModel {

    public $username;
    public $login;
    public $password;
    public $phone;
    public $address;
    public $email;
    public $agree = false;
    public $rememberMe;
    private $_identity;
    public $rules;
    public $occupation;
    public $about;
    public $avatar;
    public $lastname;
    public $firstname;
    public $middlename;
    public $caption;
    public $step1;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('login', 'testLogin'),
            array('email', 'testEmail'),

            array('login', 'required', 'message' =>'Необходимо ввести логин'),
            #array('username', 'required', 'message' =>'Необходимо ввести ваше ФИО или ФИ'),
            array('password', 'required', 'message' =>'Необходимо придумать пароль'),
            array('email', 'required', 'message' =>'Необходимо указать Ваш электронный ящик'),
            array('rules', 'required', 'message' =>'Необходимо принять правила сайта'),

            array('firstname', 'required', 'message' =>'Необходимо ввести Ваше имя'),
            array('lastname', 'required', 'message' =>'Необходимо ввести Вашу фамилию'),

            array('avatar', 'file', 'types'=>'jpg, gif, png', 'allowEmpty' => true, 'maxSize' => 8388608),

            array('login, username', 'length', 'max' => '100', 'min' => '3',
                'tooLong' => 'Не более 100 символов',
                'tooShort' => 'Не менее 3-х символов'),
            array('password', 'length', 'max' => '25', 'min' => '6',
                'tooLong' => 'Не более 25 символов',
                'tooShort' => 'Пароль слишком короткий'),
            array('address', 'length', 'max' => '255', 'min' => '10',
                'tooLong' => 'Не более 255 символов',
                'tooShort' => 'Адрес слишком короткий'),
            array('phone', 'length', 'max' => '50', 'min' => '6',
                'tooLong' => 'Не более 50 символов',
                'tooShort' => 'Телефон слишком короткий'),
            array('agree', 'required', 'message' => 'Без согласия регистрация не возможна'),
            // rememberMe needs to be a boolean
            array('rememberMe, agree', 'boolean'),
            array('email', 'email', 'message' => 'Введите действующий email'),
            array('caption, middlename','safe'),
            #array('login', 'uniqueLogin', 'className' => 'Users', 'attributeName' => 'username',
            #    'caseSensitive' => 'false'),
            // password needs to be authenticated
           # array('password', 'authenticate'),
        );
    }

    public function testlogin($attribute, $params) {
        $l = User::model()->find('name = "' . $this->login . '"');
        if ($l) {
            $this->addError('login', 'Такой псевдоним уже используется. Попробуйте другой.');
        }
    }

    public function testEmail($attribute, $params) {
        $l = User::model()->find('email = "' . $this->email . '"');
        if ($l) {
            $this->addError('email', 'Такой email уже используется.');
        }
    }
    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => 'Запомнить введенные данные',
            'username' => 'ФИО',
            'login' => 'Ник',
            'password' => 'Пароль',
            'email' => 'Электронная почта',
            'agree' => 'Согласен(-на) на обработку персональных данных',
            'phone' => 'Номер телефона',
            'address' => 'Адрес (можно производственный)',
            'rules' => 'Согласен(-на) на соблюдение <a href="/rules" target="_blank">правил сайта</a>',
            'level' => 'Уровень регистрации',
            'occupation' => 'Род занятий',
            'about' => 'О себе',
            'avatar' => 'Ваше фото',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'middlename' => 'Отчество',
            'caption' => 'Подписывать мои комментарии ',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate())
                $this->addError('password', 'Incorrect username or password.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        else
            return false;
    }

    public function uniqueLogin($attribute, $params = array()) {
        if (!$this->hasErrors()) {
            $this->addError('login', 'Incorrect username or password.');
            $params['criteria'] = array(
                'condition' => 'username=:username',
                'params' => array(':username' => $this->login),
            );
            $validator = CValidator::createValidator('unique', $this, $attribute, $params);
            $validator->validate($this, array($attribute));
        }
    }

}
