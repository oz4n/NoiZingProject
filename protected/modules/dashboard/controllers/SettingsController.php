<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SettingsController
 *
 * @author melengo
 */
class SettingsController extends AdminController {

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
    }

    public function actionIndex() {
        $this->render('index', array());
    }

}
