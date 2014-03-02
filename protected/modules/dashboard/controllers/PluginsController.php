<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginsController
 *
 * @author melengo
 */
class PluginsController extends AdminController {

    public function accessRules() {
        return array(
//            array('allow',
//                'actions' => array('accounts', 'dashboard', 'create', 'list', 'update', 'delete', 'deleteall', 'index', 'view'),
//                'expression' => '$user->isAdministrator()',
//            ),
//            array('deny',
//                'users' => array('*'),
//            )
        );
    }

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerScript('more-list', "$('ul.nav > li.more-list').addClass('active')", CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('components-list', "$('ul.dropdown-menu > li.components-list').addClass('active')", CClientScript::POS_READY);
    }

    public function actionIndex() {
        $plugin = new Component();
        $this->render('index', array('plugin' => $plugin));
    }

    public function actionInstall() {
        $plugin = new Component();
        $this->render('install', array('plugin'=>$plugin));
    }
    
    public function actionSave(){
        
    }
    
    public function actionUpdate(){
        
    }

}

