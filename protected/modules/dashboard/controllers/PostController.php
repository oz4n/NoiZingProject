<?php

class PostController extends AdminController {

    public function filters() {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function init() {
        parent::init();

        Yii::app()->clientScript->registerScript('postcontroller-js-app-url', "
            var loadIamageURL = '" . Yii::app()->createUrl("dropbox/cache/getmodalimages") . "';
            var image_orginal_100_path = '" . Yii::app()->baseUrl . "/cache/images/thumbnails/orginal_100/" . "';
            var image_orginal_path = '" . Yii::app()->baseUrl . "/cache/images/thumbnails/orginal/" . "';
            ", CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScript('postcontroller-js-app', "PostController.init();", CClientScript::POS_READY);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.min.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/css/msgGrowl.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/js/msgGrowl.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/js/plugins/fileupload/bootstrap-fileupload.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/fileupload/bootstrap-fileupload.js', CClientScript::POS_HEAD);

        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/jform/jquery.form.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/app/PostController.js', CClientScript::POS_HEAD);

        Yii::app()->CInfo->setTrue_save_info('Post');
        Yii::app()->CInfo->setFalse_save_info('Post');
        Yii::app()->CInfo->setTrue_delete_info('Post');
        Yii::app()->CInfo->setFalse_delete_info('Post');
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array(
                    'suggesttags',
                    'create',
                    'update',
                    'delete',
                    'index',
                    'view'
                ),
                'expression' => '$user->isAdministrator()',
            ),
            array('deny',
                'users' => array('*'),
            )
        );
    }

    public function actionIndex() {
        $post = new Post('search');
        $post->unsetAttributes();
        if (isset($_GET['Post']))
            $post->attributes = $_GET['Post'];

        $this->render('index', array(
            'post' => $post,
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
        $post = new Post;
        $this->performAjaxValidation($post);
        if (isset($_POST['Post'])) {
            $post->attributes = $_POST['Post'];
            $post->setPage(is_array(@$_POST['Post']['categories']) ? $_POST['Post']['categories'] : array());
            $post->setRelationRecords('categories', is_array(@$_POST['Post']['categories']) ? $_POST['Post']['categories'] : array());
            $this->runSave($post->save());
        } else {
            $this->render(
                    'create', array(
                'post' => $post,
                    )
            );
        }
    }

    public function actionUpdate($id) {

        $post = $this->loadModel($id);
        $this->performAjaxValidation($post);
        if (isset($_POST['Post'])) {
            $post->account_id = Yii::app()->user->id;
            $post->attributes = $_POST['Post'];
            $post->setPage(is_array(@$_POST['Post']['categories']) ? $_POST['Post']['categories'] : array());
            $post->setRelationRecords('categories', is_array(@$_POST['Post']['categories']) ? $_POST['Post']['categories'] : array());
            $this->runSave($post->save());
        } else {
            $this->render('update', array('post' => $post));
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
        $post = Post::model()->findByPk($id);
        if ($post === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $post;
    }

    protected function performAjaxValidation($post) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($post);
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
