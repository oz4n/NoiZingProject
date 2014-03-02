<?php

class GuestbookModule extends CWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        Yii::app()->clientScript->registerScript('more-list', "$('ul.nav > li.more-list').addClass('active')", CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('components-list', "$('ul.dropdown-menu > li.components-list').addClass('active')", CClientScript::POS_READY);
        $this->setImport(array(
            'guestbook.models.GuestBook',
            'site.components.MenuCloud',
            'site.models.NavMenu',
            'site.models.Comment',
            'site.models.Post',
            'site.models.TermTaxonomy',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
