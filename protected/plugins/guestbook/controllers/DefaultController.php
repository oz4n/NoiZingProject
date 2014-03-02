<?php

class DefaultController extends AdminController {

    public $layout = 'guestbook.views.layouts.dashboard.main';
    
    public function init() {
        parent::init();
    }
    
    public function actionIndex() {
        $this->render('index');
    }

}