<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApsActiveRecord
 *
 * @author melengo
 */
class ApsActiveRecord extends CActiveRecord {

    private static $apsdb = null;

    protected static function getAdvertDbConnection() {
        if (self::$apsdb !== null)
            return self::$apsdb;
        else {
            self::$apsdb = Yii::app()->apsdb;
            if (self::$apsdb instanceof CDbConnection) {
                self::$apsdb->setActive(true);
                return self::$apsdb;
            }
            else
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
        }
    }

}

