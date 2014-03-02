<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EWebuser
 *
 * @author melengo
 */
class EWebUser extends CWebUser {

    protected $_model;

    function isAdministrator() {
        $user = $this->loadUser();
        if ($user)
            return $user->level == Level::ADMINISTRATOR;
        return false;
    }

    function isOperator() {
        $user = $this->loadUser();
        if ($user)
            return $user->level == Level::OPERATOR;
        return false;
    }

    function isUser() {
        $user = $this->loadUser();
        if ($user)
            return $user->level == Level::USER;
        return false;
    }
    
   
    // Load user model.
    protected function loadUser() {
        if ($this->_model === null) {
            $this->_model = Account::model()->findByPk($this->id);
        }
        return $this->_model;
    }

}