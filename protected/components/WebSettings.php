<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebSettings
 *
 * @author melengo
 */
class WebSettings extends CApplicationComponent {
    
    public function getModule(){
        $model = Modules::model()->findByPk(1);
        return $model->name;
    }
}
