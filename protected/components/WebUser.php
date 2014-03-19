<?php

class WebUser extends CWebUser {

    private $_model = null;

    function getRole() {
        if ($user = $this->getModel()) {
            // в таблице User есть поле role
            return $user;
        }
    }

    private function getModel() {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->with('perm')->findByPk($this->id)->perm->alias;
        }
        return $this->_model;
    }

}

?>
