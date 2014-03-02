<?php

class TagController extends AdminController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.min.js', CClientScript::POS_END);

        //msgGrowl
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/css/msgGrowl.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/js/msgGrowl.js', CClientScript::POS_END);

        Yii::app()->CInfo->setTrue_save_info('Tag');
        Yii::app()->CInfo->setFalse_save_info('Tag');
        Yii::app()->CInfo->setTrue_delete_info('Tag');
        Yii::app()->CInfo->setFalse_delete_info('Tag');
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
//            array('allow', // allow all users to perform 'index' and 'view' actions
//                'actions' => array('index', 'view'),
//                'users' => array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array('create', 'update'),
//                'users' => array('@'),
//            ),
//            array('allow', // allow dashboard user to perform 'dashboard' and 'delete' actions
//                'actions' => array('dashboard', 'delete'),
//                'users' => array('dashboard'),
//            ),
//            array('deny', // deny all users
//                'users' => array('*'),
//            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' pages.
     */
    public function actionCreate() {
        $tag = new Tag;
        $this->performAjaxValidation($tag);
        if (isset($_POST['Tag'])) {
            $tag->attributes = $_POST['Tag'];
            $this->runSave($tag->save());
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' pages.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::app()->clientScript->registerScript('articel-list', "$('ul.nav > li.articels-list').addClass('active')", CClientScript::POS_READY);
        $tag = $this->loadModel($id);        
        $this->performAjaxValidation($tag);        
        if (isset($_POST['Tag'])) {
            $tag->attributes = $_POST['Tag'];
            $this->runSave($tag->save());
        }

        $this->render('update', array(
            'tag' => $tag,
        ));
    }

    public function actionQuikUpdate($id) {
        $tag = $this->loadModel($id);
        $this->performAjaxValidation($tag);
        if (isset($_POST['Tag'])) {
            $tag->attributes = $_POST['Tag'];
            $this->runSave($tag->save());
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

   
    public function actionDelete() {
        if (isset($_POST)) {
            $this->loadModel($_POST['id'])->delete();
            echo CJSON::encode(Yii::app()->CInfo->getTrue_delete_info());
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

  
    public function actionIndex() {
        $this->initJsIndexGeneret();
        $tag = new Tag('search');
        $tag->unsetAttributes(); 
        if (isset($_GET['Tag']))
            $tag->attributes = $_GET['Tag'];

        $this->render('index', array(
            'tag' => $tag,
        ));
    }

    public function loadModel($id) {
        $tag = Tag::model()->findByPk($id);
        if ($tag === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $tag;
    }

    protected function performAjaxValidation($tag) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tag-form') {
            echo CActiveForm::validate($tag);
            Yii::app()->end();
        }
    }

    private function initJsIndexGeneret() {
        Yii::app()->clientScript->registerScript('articel-list', "$('ul.nav > li.articels-list').addClass('active')", CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('tag-delete', '$(".delete-box").live("click", function(e) { var id = e.srcElement.className.split("id-"); $.msgbox("Are you sure that you want to permanently delete the selected element?", {type: "confirm", buttons: [{type: "submit", value: "Yes"}, {type: "submit", value: "No"}]}, function(result) { if (result === "Yes") { $.ajax({url: "' . Yii::app()->createUrl("dashboard/tag/delete") . '", data: {id: id[1]}, dataType: "JSON", type: "POST"}).done(function(response) { $.msgGrowl({type: response.type, title: response.title, text: response.text}); $.fn.yiiGridView.update("tag-grid"); }); } }); });', CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('form-tag-quikupdate', '$("span.tag-quick-edit").live("click", function(e){ $(this).parent().parent().children().css("display","none");$(this).parent().parent().prepend(\'<td colspan="3" class="form-edit" ><div class="row-fluid"><h4>Quick Edit</h4><form method="POST" class="form-tag" action="' . Yii::app()->createUrl('dashboard/tag/quikupdate', array('id' => '')) . '/\'+ $(this).attr("id") +\'"> <div class="control-group"><div class="controls"><input type="text" name="Tag[name]" value="\'+  $(this).attr("name") +\'" class="span12" placeholder="Name" required></div></div><button type="button" class="cancel btn btn-small pull-left">Cencel</button> <button type="submit" class="update btn btn-small pull-right">Update Category</button></form></div></td>\');  });$("button.cancel").live("click", function() {$(this).parent().parent().parent().parent().children().css("display", "");$(this).parent().parent().parent().remove(); }); $(".form-tag").live("submit", function() { $.ajax({url: $(this).attr("action"), data: $(this).serialize(), dataType: "JSON", type: "POST"}).done(function(response) { if (response.data === true) {$.msgGrowl({type: response.type, title: response.title, text: response.text});$.fn.yiiGridView.update("tag-grid"); } else {$.msgGrowl({type: response.type, title: response.title, text: response.text}); } });return false; });', CClientScript::POS_READY);
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
