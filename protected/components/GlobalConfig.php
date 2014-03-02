<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GlobalConfig
 *
 * @author melengo
 */
class GlobalConfig {

    public static function extHome() {
        return self::arryToObjek(Yii::app()->params['home']);
    }

    public static function arryToObjek($array) {
        return (object) $array;
    }

    public static function prelog($array, $pre = false) {
        if ($pre == false) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        } else {
            echo "<pre>";
            var_dump($array);
            echo "</pre>";
        }
    }

}

