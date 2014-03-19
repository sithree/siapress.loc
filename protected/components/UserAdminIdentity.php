<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserAdminIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $email = strtolower($this->username);

        if (strtolower($this->username) and $this->password) {
            if ($this->username !== 'admin')
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            else if ($this->password !== 'soler5pisig')
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else {
                $this->_id = 1;
                $this->username = 'admin';
                $this->errorCode = self::ERROR_NONE;

            }
        }

        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId() {
        return $this->_id;
    }

}