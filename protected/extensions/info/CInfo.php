<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CInfo
 *
 * @author melengo
 */
class CInfo extends CApplicationComponent {

  
    public $true_save_info = array();
    public $false_save_info = array();
    public $true_delete_info = array();
    public $false_delete_info = array();

    public function getTrue_save_info() {
        return $this->true_save_info;
    }

    public function setTrue_save_info($true_save_info) {
        $this->true_save_info = array('data' => true, 'type' => 'success', 'title' => $true_save_info, 'text' => $true_save_info. ' has been saved successfully');
        return $this;
    }

    public function getFalse_save_info() {
        return $this->false_save_info;
    }

    public function setFalse_save_info($false_save_info) {
        $this->false_save_info = array('data' => false, 'type' => 'error', 'title' => $false_save_info, 'text' => $false_save_info.' failed to save');
        return $this;
    }

    public function getTrue_delete_info() {
        return $this->true_delete_info;
    }

    public function setTrue_delete_info($true_delete_info) {
        $this->true_delete_info = array('data' => true, 'type' => 'success', 'title' => $true_delete_info, 'text' => $true_delete_info. ' has been deleted successfully');
        return $this;
    }

    public function getFalse_delete_info() {
        return $this->false_delete_info;
    }

    public function setFalse_delete_info($false_delete_info) {
        $this->false_delete_info = array('data' => false, 'type' => 'error', 'title' => $false_delete_info, 'text' => $false_delete_info. ' failed to delete');
        return $this;
    }

}
