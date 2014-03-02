<?php

class PageController extends AdminController {

    public function filters() {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerScript('pages-list', "$('ul.nav > li.pages-list').addClass('active')", CClientScript::POS_READY);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.min.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/css/msgGrowl.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/js/msgGrowl.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/js/plugins/fileupload/bootstrap-fileupload.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/fileupload/bootstrap-fileupload.js', CClientScript::POS_HEAD);

        Yii::app()->CInfo->setTrue_save_info('Page');
        Yii::app()->CInfo->setFalse_save_info('Page');
        Yii::app()->CInfo->setTrue_delete_info('Page');
        Yii::app()->CInfo->setFalse_delete_info('Page');
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('up', 'test', 'suggesttags', 'create', 'update', 'delete', 'index', 'view'),
                'expression' => '$user->isAdministrator()',
            ),
            array('deny',
                'users' => array('*'),
            )
        );
    }

    public function actionIndex() {
        Yii::app()->clientScript->registerScript('pages-delete', '$(".delete-box").live("click", function(e) { var id = $(this).attr("id"); $.msgbox("Are you sure that you want to permanently delete the selected element?", {type: "confirm", buttons: [{type: "submit", value: "Yes"}, {type: "submit", value: "No"}]}, function(result) { if (result === "Yes") { $.ajax({url: "' . Yii::app()->createUrl("dashboard/pages/delete") . '", data: {id: id}, dataType: "JSON", type: "POST"}).done(function(response) { $.msgGrowl({type: response.type, title: response.title, text: response.text}); $.fn.yiiListView.update("pages-list");  }); } }); });', CClientScript::POS_READY);
        $page = new Page('search');
        $page->unsetAttributes();
        if (isset($_GET['Page']))
            $page->attributes = $_GET['Page'];

        $this->render('index', array(
            'page' => $page,
        ));
    }

    public function actionDelete() {
        if (isset($_POST['id'])) {
            $this->loadModel($_POST['id'])->delete();
            echo CJSON::encode(Yii::app()->CInfo->getTrue_delete_info());
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    public function actionCreate() {
        $page = new Page;
        $this->performAjaxValidation($page);
        if (isset($_POST['Page'])) {
            $page->attributes = $_POST['Page']; 
            $page->setPage(is_array(@$_POST['Page']['categories']) ? $_POST['Page']['categories'] : array());
            $page->setRelationRecords('categories', is_array(@$_POST['Page']['categories']) ? $_POST['Page']['categories'] : array());
            $this->runSave($page->save());
        } else {
            $this->render('create', array('page' => $page));
        }
    }

    public function actionUpdate($id) {

        $page = $this->loadModel($id);
        $this->performAjaxValidation($page);
        if (isset($_POST['Page'])) {
            $page->account_id = Yii::app()->user->id;
            $page->attributes = $_POST['Page'];
            $page->setPage(is_array(@$_POST['Page']['categories']) ? $_POST['Page']['categories'] : array());
            $page->setRelationRecords('categories', is_array(@$_POST['Page']['categories']) ? $_POST['Page']['categories'] : array());
            $this->runSave($page->save());
        } else {
            $this->render('update', array('page' => $page));
        }
    }

    public function actionSuggestTags() {
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = Tag::model()->suggestTags($keyword);
            if ($tags !== array())
                echo implode("\n", $tags);
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    protected function loadModel($id) {
        $page = Page::model()->findByPk($id);
        if ($page === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $page;
    }

    protected function performAjaxValidation($page) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pages-form') {
            echo CActiveForm::validate($page);
            Yii::app()->end();
        }
    }

    protected function runSave($save) {
        if ($save) {
            echo CJSON::encode(Yii::app()->CInfo->getTrue_save_info());
            exit();
        } else {
            echo CJSON::encode(Yii::app()->CInfo->getFalse_save_info());
            exit();
        }
    }

}
