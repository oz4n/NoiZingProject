<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TweetsController
 *
 * @author melengo
 */

defined('TWEETS') or define('TWEETS', dirname(__FILE__) .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'cache' . DIRECTORY_SEPARATOR . 'tweets.json');
class TweetsController extends CController {

    public function actionIndex() {        
        if ($_POST['tweets']) {
            $data = Yii::app()->twitter->getAccountTweets(25, 'oz4n3', false);           
            if($data !== null || $data->errors[0]->code !== 32 || $data->errors[0]->code !== 86){
                return $this->createStr(TWEETS, json_encode($data));
            }            
        } else {
            throw new CHttpException(404, 'tes');
        }
    }
    
    
   
    protected function createStr($file, $string) {
        $fw = fopen($file, 'w');
        if (!$fw) {
            throw new CHttpException(404, 'File Not font');
        } else {
            fwrite($fw, $string);
            fclose($fw);
        }
    }
    
    public function actionTest(){
        CVarDumper::dump(Yii::app()->twitter->getAccountTweets(2, 'oz4n3', false),1000,true);
    }

}

