<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IDropBox
 *
 * @author melengo
 */
class IDropBox extends CApplicationComponent {
    
    //consumer key
    public $key;
    public $secret;
    
    // mode encrypter 32 bit
    public $encrypter;
    
    // root mode ex:dropbox || sandbox
    public $root;
    
    // DB config conection
    public $db = array();
    
    public $yiiDbConection = true;
    // User ID assigned by your auth system (used by persistent storage handlers)
    private $userID = 1;    
    
    private $api;
    private $OAuth;
    
   
    
    public function init() {
        Yii::setPathOfAlias('dropbox', dirname(__FILE__));
        Yii::import('dropbox.OAuth.*');
        Yii::import('dropbox.OAuth.Consumer.*');
        Yii::import('dropbox.OAuth.Storage.*');
        
        // Check whether to use HTTPS and set the callback URL
        $protocol = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
        $callback = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        
        // Instantiate the Encrypter and storage objects
        $encrypter = new Encrypter($this->encrypter);
        
        // Instantiate the database data store and connect
        $storage = new DPDO($encrypter, $this->userID); 
        if ($this->yiiDbConection){
            $storage->yiiDbConnect(Yii::app()->db->connectionString, Yii::app()->db->username,Yii::app()->db->password);            
        }else{
            $storage->dbConnect($this->db['host'],$this->db['db_name'], $this->db['db_user'],$this->db['db_pass'], $this->db['db_port']);
        }
        
        $this->OAuth = new Curl($this->key, $this->secret, $storage, $callback);
        $this->api = new API($this->OAuth);
        $this->api->setRoot($this->root);
        parent::init();
    }
    
    public function getThumbnails($file, $format, $size){
        $data = $this->api->thumbnails($file, $format, $size);
        return $data;
    }
    
}

