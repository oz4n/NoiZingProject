<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IRegularExpression
 *
 * @author melengo
 */

defined('DEBUG_FILE_PREFIX') or define('DEBUG_FILE_PREFIX',dirname(__FILE__)."/tmp/findlinks_");
defined('DEBUG') or define('DEBUG',false);

class IRegularExpression extends CApplicationComponent {
    
    public function replaceLink($html) {
        return $result = preg_replace(
                '%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s', '<a href="$1" target="_blank" rel="tooltip" data-original-title="Go home">$1</a>', $html
        );
    }
    
    public function getTagPositions($string) {        
     
        $strBody = html_entity_decode($string);
        preg_match_all("/<[^>]+>(.*)<\/[^>]+>/U", $strBody, $strTag, PREG_PATTERN_ORDER);
        $intOffset = 0;
        $intIndex = 0;
        $intTagPositions = array();

        foreach ($strTag[0] as $strFullTag) {
            if (DEBUG == true) {
                $fhDebug = fopen(DEBUG_FILE_PREFIX . time(), "a");
                fwrite($fhDebug, $fulltag . "\n");
                fwrite($fhDebug, "Starting position: " . strpos($strBody, $strFullTag, $intOffset) . "\n");
                fwrite($fhDebug, "Ending position: " . (strpos($strBody, $strFullTag, $intOffset) + strlen($strFullTag)) . "\n");
                fwrite($fhDebug, "Length: " . strlen($strFullTag) . "\n\n");
                fclose($fhDebug);
            }
            $intTagPositions[$intIndex] = array('start' => (strpos($strBody, $strFullTag, $intOffset)), 'end' => (strpos($strBody, $strFullTag, $intOffset) + strlen($strFullTag)));
            $intOffset += strlen($strFullTag);
            $intIndex++;
        }
        return $intTagPositions;
    }

}
