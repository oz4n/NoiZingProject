<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItwiterOAouth
 *
 * @author melengo
 */
class ItwiterOAouth extends CApplicationComponent {

    public $consumer_key;
    public $consumer_secret;
    public $access_token;
    public $access_token_secret;
    public $get_tweets_limits;
    public $account;
    private $OAuth;
    private $convert;

    public function init() {
        Yii::setPathOfAlias('twitteroauth', dirname(__FILE__));
        Yii::import('twitteroauth.core.*');
        $this->OAuth = new tmhOAuth(array(
                    'consumer_key' => $this->consumer_key,
                    'consumer_secret' => $this->consumer_secret,
                    'user_token' => $this->access_token,
                    'user_secret' => $this->access_token_secret,
                ));
        $this->convert = new IConverter();
        parent::init();
    }

    public function postTweets($post, $objk = true) {
        $code = $this->OAuth->request('POST', $this->OAuth->url('1.1/statuses/update'), array(
            'status' => $post
                ));
        $data = json_decode($this->OAuth->response['response']);
        if ($objek == false && $limit == 1)
            return $data;
        else
            return $this->convert->arrayToObject($data);
    }

    public function getAccountTweets($limit = 5, $user, $objek = false) {
        $code = $this->OAuth->request('GET', $this->OAuth->url('1.1/statuses/home_timeline'), array(
            'include_entities' => '1',
            'include_rts' => '1',
            'screen_name' => $user,
            'count' => $limit,
                ));
//        $cac = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cache/getaccounttweets.json';
//        $this->addCache($cac, "\n" . $this->OAuth->response['response']);
        $data = json_decode($this->OAuth->response['response']);
//        $ob = array();
        if ($objek == false) {
            return $data;
        } else {
            return $this->convert->arrayToObject($data);
        }
    }

    private function addCache($file, $string) {
        $fw = fopen($file, 'a');
        if (!$fw) {
            throw new CHttpException(403, 'File Not font');
        } else {
            fwrite($fw, $string);
            fclose($fw);
        }
    }

}

