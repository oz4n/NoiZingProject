<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecentTweets
 *
 * @author melengo
 */
defined('CACHE_TWEETS') or define('CACHE_TWEETS', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'tweets.json');

class RecentTweets extends IWidgets {

    public function init() {
        $this->registerScript();
        parent::init();
    }

    public function getRecentTweets() {
        $data = file_get_contents(CACHE_TWEETS);
        return json_decode($data);
    }

    protected function renderContent() {
        $title = "Recent Tweets";
        $limit = 20;
        $this->render('recentTweets', array('title' => $title, 'limit' => $limit));
    }
    
    
    protected function registerScript() {
          Yii::app()->clientScript->registerScript(__CLASS__,$this->ajaxLink(Yii::app()->request->hostInfo.Yii::app()->baseUrl."/index.php/tweets/index", "timeline", 1800000), CClientScript::POS_END);
          
//          Yii::app()->clientScript->registerScript(__CLASS__,'setInterval("console.log(\"melengo\")",960000);', CClientScript::POS_END);
    }
    
    protected function ajaxLink($url , $data, $interval){
       return ' $(document).ready(function() { setInterval("ajaxd()",'.$interval.'); }); function ajaxd() { $.ajax({ type: "POST",url: "'.$url.'",data: "tweets='.$data.'"}); }';
    }

}
