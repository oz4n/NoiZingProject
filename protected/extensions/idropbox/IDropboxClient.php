<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IDropboxClient
 * @var $dbclient Client
 * @author melengo
 */
require_once dirname(__FILE__) . "/Dropbox/autoload.php";

use \Dropbox as dbx;

class IDropboxClient extends CApplicationComponent {

    public $dbVersion = "PHP-Dropbox/1.0";
    public $access_token;
    public $dbclient;

    public function init() {
        parent::init();
        $this->dbclient = new dbx\Client($this->access_token, $this->dbVersion);
    }

    public function getAccountInfo() {
        return $this->dbclient->getAccountInfo();
    }

    public function upload($db_path, $lc_path) {
        return $this->dbclient->uploadFile($db_path, dbx\WriteMode::add(), fopen($lc_path, 'rb'));
    }
    
    public function shareLink($path){
        return $this->dbclient->createShareableLink($path);
    }

}
