<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IExplodeImg
 *
 * @author melengo
 */
class IExplodeImg extends CWidget {
    
    public $content;
    public $imagetitle;
    
    public function run() {
        $this->explodeImgContent();
        return parent::run();
    }
    
    private function explodeImgContent() {
        if (preg_match('/<img(.*?)>/', $this->content, $matches)) {            
            $ex = explode('=', $matches[1]);           
            echo '<div class="picture">';
            echo CHtml::link($matches[0].'<div class="image-overlay-zoom"></div>', str_replace('"', '', $ex[1]), array('rel'=>'image','title'=> $this->imagetitle));                     
            echo '</div>';
        }else{
            return false;
        }
    }

}
