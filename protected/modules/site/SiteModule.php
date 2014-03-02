<?php

class SiteModule extends CWebModule {

    public function init() {
        $this->setImport(array(
            'site.components.*',
            'site.models.*',
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
