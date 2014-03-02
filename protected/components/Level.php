<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Level
 *
 * @author melengo
 */
class Level {

    const ADMINISTRATOR = 'A';
    const OPERATOR = 'O';
    const USER = 'U';
   
    
//    const ADMINISTRATOR = '0';
//    const OPERATOR = '2';
//    const STUDENT = '3';
//    const TEACHER = '4';
    
    // For CGridView, CListView Purposes
    public static function getLavel($level) {
        if ($level == self::ADMINISTRATOR)
            return 'A';
        if ($level == self::OPERATOR)
            return '0';
        if ($level == self::USER)
            return 'U';        
        return false;
    }

    // for dropdown lists purposes
    public static function getLevelList() {
        return array(
            self::ADMINISTRATOR => 'A',
            self::OPERATOR => 'O',
            self::USER => 'U',           
        );
    }

}