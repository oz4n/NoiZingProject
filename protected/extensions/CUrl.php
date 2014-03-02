<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CUrl
 *
 * @author melengo
 */
class CUrl extends CApplicationComponent {

    public function segment($n) {       
        $ex = explode("/", str_replace(Yii::app()->getHomeUrl(), "", $_SERVER['REQUEST_URI']));
        return $ex[$n];
    }

}