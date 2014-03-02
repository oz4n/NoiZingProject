<?php

class DefaultController extends AdminController {

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/libs/jquery-1.7.2.min.js', CClientScript::POS_HEAD);
    }
    
    

    public function actionIndex() {
//        $this->layout = 'dashboard.views.layouts.main';
        $this->render('index');
    }
    
    

        public function actionTest(){
//        echo $_SERVER['REQUEST_URI'].'<br>';
//        echo $_SERVER['SCRIPT_NAME'].'<br>';
//        echo $_SERVER['HTTP_HOST'].'<br>';
//        echo $_SERVER['SERVER_NAME'].'<br>';
        echo Yii::app()->CUrl->segment(1);
        
    }

}