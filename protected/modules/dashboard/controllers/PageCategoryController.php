<?php

class PageCategoryController extends AdminController {

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerScript('pages-list', "$('ul.nav > li.pages-list').addClass('active')", CClientScript::POS_READY);
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.min.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/css/msgGrowl.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/js/msgGrowl.js', CClientScript::POS_END);

        Yii::app()->CInfo->setTrue_save_info('Page Category');
        Yii::app()->CInfo->setFalse_save_info('Page Category');
        Yii::app()->CInfo->setTrue_delete_info('Page Category');
        Yii::app()->CInfo->setFalse_delete_info('Page Category');
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

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

    public function actionCreate() {
        $pagecategory = new Term;
        $this->performAjaxValidation($pagecategory);
        if (isset($_POST['Term'])) {
            $pagecategory->attributes = $_POST['Term'];
            $pagecategory->termTaxonomies = array(array('type'=>'pages','parent' => $_POST['Term']['parent'], 'description' => $_POST['Term']['description'], 'status' => $_POST['Term']['status']));
            if ($pagecategory->saveWithRelated('termTaxonomies')) {
                echo CJSON::encode(array_merge(Yii::app()->CInfo->getTrue_save_info(), array('id' => $pagecategory->termTaxonomies[0]->id, 'name' => ucwords($pagecategory->name))));
                exit();
            } else {
                echo CJSON::encode(Yii::app()->CInfo->getFalse_save_info());
                exit();
            }
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    public function actionUpdate($id) {       
        $pagecategory = $this->loadModel($id);
        $this->performAjaxValidation($pagecategory);
        if (isset($_POST['Term'])) {
            $pagecategory->attributes = $_POST['Term'];
            $pagecategory->termTaxonomies = array(array('parent' => $_POST['Term']['parent'],'description' => $_POST['Term']['description'],'status' => $_POST['Term']['status']));
            $this->runSave($pagecategory->saveWithRelated('termTaxonomies'));
        }
        else
            $this->render('update', array('pagecategory' => $pagecategory));
    }

    public function actionQuikUpdate($id) {
        $pagecategory = $this->loadModel($id);
        $this->performAjaxValidation($pagecategory);
        if (isset($_POST['Term'])) {
            $pagecategory->attributes = $_POST['Term'];
            $this->runSave($pagecategory->save());
        }
        else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    public function actionDelete() {
        if (isset($_POST)) {
            $cat_id = $this->loadModel($_POST['id'])->termTaxonomies[0]->id;
            $this->loadModel($_POST['id'])->delete();
            echo CJSON::encode(array_merge(Yii::app()->CInfo->getTrue_delete_info(),array('cat_id'=>$cat_id)));
        } else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }
    
  
    public function actionIndex() {
        $this->initJsIndexGeneret();
        $pagecategory = new Term;
        $pagecategory->unsetAttributes();
        if (isset($_GET['Term']))
            $pagecategory->attributes = $_GET['Term'];

        $this->render('index', array(
            'pagecategory' => $pagecategory,
        ));
    }

    public function loadModel($id) {
        $model = Term::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pagecategory-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function initJsIndexGeneret() {
        Yii::app()->clientScript->registerScript('pagecategory-delete', '$(".delete-box").live("click", function(e) { var id = e.srcElement.className.split("id-"); $.msgbox("Are you sure that you want to permanently delete the selected element?", {type: "confirm", buttons: [{type: "submit", value: "Yes"}, {type: "submit", value: "No"}]}, function(result) { if (result === "Yes") { $.ajax({url: "' . Yii::app()->createUrl("dashboard/pagecategory/delete") . '", data: {id: id[1]}, dataType: "JSON", type: "POST"}).done(function(response) { $.msgGrowl({type: response.type, title: response.title, text: response.text}); $.fn.yiiGridView.update("pagecategory-grid"); $("#drop-pagecategory-list option[value=\'" + response.cat_id +"\']").remove(); }); } }); });', CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('form-pagecategory-quikupdate', '$("span.cat-quick-edit").live("click", function(e){ $(this).parent().parent().children().css("display","none");$(this).parent().parent().prepend(\'<td colspan="3" class="form-edit" ><div class="row-fluid"><h4>Quick Edit</h4><form method="POST" class="form-cat" action="' . Yii::app()->createUrl('dashboard/pagecategory/quikupdate', array('id' => '')) . '/\'+ $(this).attr("id") +\'"> <div class="control-group"><div class="controls"><input type="text" name="Term[name]" value="\'+  $(this).attr("name") +\'" class="span12" placeholder="Name" required></div></div><div class="control-group"><div class="controls"><input type="text" name="Term[slug]" value="\'+ $(this).attr("slug") +\'" class="span12" placeholder="Slug" required><input type="hidden" name="Term[parent]" value="\'+ $(this).attr("parent") +\'" ><input type="hidden" name="Term[status]" value="\'+ $(this).attr("status") +\'"></div></div><button type="button" class="cancel btn btn-small pull-left">Cencel</button> <button type="submit" class="update btn btn-small pull-right">Update Page Category</button></form></div></td>\');  });$("button.cancel").live("click", function() {$(this).parent().parent().parent().parent().children().css("display", ""); $(this).parent().parent().parent().remove(); }); $(".form-cat").live("submit", function() { $.ajax({url: $(this).attr("action"), data: $(this).serialize(), dataType: "JSON", type: "POST"}).done(function(response) { if (response.data === true) {$.msgGrowl({type: response.type, title: response.title, text: response.text});$.fn.yiiGridView.update("pagecategory-grid"); } else {$.msgGrowl({type: response.type, title: response.title, text: response.text}); } });return false; });', CClientScript::POS_READY);
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
