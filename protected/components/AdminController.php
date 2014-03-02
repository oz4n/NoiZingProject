<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardController
 *
 * @author ozan rock
 */
class AdminController extends Controller {

    public $layout = 'dashboard.views.layouts.main';
    public $menu = array();
    public $breadcrumbs = array();
    
    public function beforeAction($action) {
        parent::beforeAction($action);
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
            return false;
        }
        return true;
    } 
   
   

}

