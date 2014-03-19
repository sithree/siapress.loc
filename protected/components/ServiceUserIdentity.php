<?php

class ServiceUserIdentity extends UserIdentity {

    const ERROR_NOT_AUTHENTICATED = 3;

    /**
     * @var EAuthServiceBase the authorization service instance.
     */
    protected $service;

    /**
     * Constructor.
     * @param EAuthServiceBase $service the authorization service instance.
     */
    public function __construct($service) {
        $this->service = $service;
    }

    /**
     * Authenticates a user based on {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        if ($this->service->isAuthenticated) {
            $this->username = $this->service->getAttribute('name');
            $this->setState('id', $this->id);
            $this->setState('name', $this->username);
            $this->setState('service', $this->service->serviceName);
            $this->setState('username', $this->service->username);



            $this->setState('isGuest', false);

            $this->errorCode = self::ERROR_NONE;

            if ($this->service->serviceName == 'vkontakte') {
                $user = User::model()->find('`vk_id` = ' . $this->service->id);

                @$this->setState('city', $this->service->getAttribute('city'));
                @$this->setState('photo', $this->service->getAttribute('photo'));
                @$this->setState('photo_medium', $this->service->getAttribute('photo_medium'));
                @$this->setState('photo_big', $this->service->getAttribute('photo_big'));
                @$this->setState('photo_rec', $this->service->getAttribute('photo_rec'));

                // Если пользователь найден в базе
                if ($user) {
                    $this->setState('id', $user->id);
                    $user->last_visit = new CDbExpression('NOW()');
                    $user->save();
                } else {
                    $user = new Users();
                    $user->name = $this->service->name;
                    $user->username = $this->service->username;
                    $user->active = 1;
                    $user->login_from = 2;
                    $user->vk_id = $this->service->id;
                    $user->perm_id = 5;
                    $user->password = 'nopassword';
                    $user->token = '1';
                    $user->last_visit = new CDbExpression('NOW()');
                    $user->register_date = new CDbExpression('NOW()');
                    $user->email = 'noemail';
                    $user->save();

                    $user->setAvatar($this->service->getAttribute('photo_rec'), 50, 50, '50');
                    $user->setAvatar($this->service->getAttribute('photo_medium'), 100, false, '100');
                    $user->setAvatar($this->service->getAttribute('photo_big'), 200, false, '200');

                    if ($user->id)
                        $this->setState('id', $user->id);
                    else {
                        die('Ошибка авторизации.');
                    }
                }
            } elseif ($this->service->serviceName == 'facebook') {
                $user = User::model()->find('`fb_id` = ' . $this->service->id);

                // Если пользователь найден в базе
                if ($user) {
                    $this->setState('id', $user->id);
                    $user->last_visit = new CDbExpression('NOW()');
                    $user->save();
                } else {
                    $user = new Users();
                    $user->name = $this->service->name;
                    $user->username = $this->service->username;
                    $user->active = 1;
                    $user->login_from = 3;
                    $user->fb_id = $this->service->id;
                    $user->perm_id = 5;
                    $user->password = 'nopassword';
                    $user->token = '1';
                    $user->last_visit = new CDbExpression('NOW()');
                    $user->register_date = new CDbExpression('NOW()');
                    $user->email = 'noemail';
                    $user->save();

                    if ($user->id)
                        $this->setState('id', $user->id);
                    else {
                        die('Ошибка авторизации.');
                    }
                }
            }
        } else {
            $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
        }
        return !$this->errorCode;
    }

}