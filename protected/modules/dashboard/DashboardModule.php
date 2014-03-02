<?php

class DashboardModule extends CWebModule {

    public function init() { 
        $this->setImport(array(
            'dashboard.models.*',
            'dropbox.models.*',
            'dashboard.components.ESaveRelatedBehavior',
            'dashboard.components.EtreeNavigasi',
            'dashboard.components.notification.*',
            'dashboard.components.ECategoryComponent'
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {          
            return true;
        }
        else
            return false;
    }
    
}
