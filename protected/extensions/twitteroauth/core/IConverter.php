<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IConverter
 *
 * @author melengo
 */
class IConverter {
    
    public function arrayToObject($array) {
        $return = new stdClass();
        foreach ($array as $k => $v) {
            if(is_int($k)){
                $k = $this->int_to_words($k);
            }else{
                $k = $k;
            }            
            if (is_array($v)) {
                $return->$k = $this->arrayToObject($v);
            } else {
                $return->$k = $v;
            }
        }
        return $return;
    }
    
    public function int_to_words($x) {
        $nwords = array(
            "zero", "one", "two", "three", "four", "five", "six", "seven",
            "eight", "nine", "ten", "eleven", "twelve", "thirteen",
            "fourteen", "fifteen", "sixteen", "seventeen", "eighteen",
            "nineteen", "twenty", 30 => "thirty", 40 => "forty",
            50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eighty",
            90 => "ninety"
        );


        if (!is_numeric($x))
            $w = '#';
        else if (fmod($x, 1) != 0)
            $w = '#';
        else {
            if ($x < 0) {
                $w = 'minus_';
                $x = -$x;
            } else
                $w = '';
            // ... now $x is a non-negative integer.

            if ($x < 21)   // 0 to 20
                $w .= $nwords[$x];
            else if ($x < 100) {   // 21 to 99
                $w .= $nwords[10 * floor($x / 10)];
                $r = fmod($x, 10);
                if ($r > 0)
                    $w .= '_' . $nwords[$r];
            } else if ($x < 1000) {   // 100 to 999
                $w .= $nwords[floor($x / 100)] . '_hundred';
                $r = fmod($x, 100);
                if ($r > 0)
                    $w .= '_and_' . $this->int_to_words($r);
            } else if ($x < 1000000) {   // 1000 to 999999
                $w .= $this->int_to_words(floor($x / 1000)) . '_thousand';
                $r = fmod($x, 1000);
                if ($r > 0) {
                    $w .= ' ';
                    if ($r < 100)
                        $w .= 'and ';
                    $w .= $this->int_to_words($r);
                }
            } else {    //  millions
                $w .= $this->int_to_words(floor($x / 1000000)) . '_million';
                $r = fmod($x, 1000000);
                if ($r > 0) {
                    $w .= ' ';
                    if ($r < 100)
                        $word .= 'and_';
                    $w .= $this->int_to_words($r);
                }
            }
        }
        return str_replace(' ', '_', $w);
    }

}
