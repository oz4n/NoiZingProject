<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonMethods
 *
 * @author melengo
 */
class CommonMethods {

    private $data = array();
   
    public function makeDropDown($parents) {
        global $data;
        $data = array();
        $data['0'] = '-- ROOT --';
        foreach ($parents as $parent) {

            $data[$parent->id] = $parent->id;
            $this->subDropDown($parent->children);
        }

        return $data;
    }

    public function subDropDown($children, $space = '---') {
        global $data;

        foreach ($children as $child) {

            $data[$child->id] = $space . $child->id;
            $this->subDropDown($child->children, $space . '---');
        }
    }

}