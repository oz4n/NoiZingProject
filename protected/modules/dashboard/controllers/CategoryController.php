<?php

class CategoryController extends AdminController
{

    public function init()
    {
        parent::init();
        Yii::app()->clientScript->registerScript('articel-list', "$('ul.nav > li.articels-list').addClass('active')", CClientScript::POS_READY);
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.min.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/css/msgGrowl.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/js/msgGrowl.js', CClientScript::POS_END);

        Yii::app()->CInfo->setTrue_save_info('Category');
        Yii::app()->CInfo->setFalse_save_info('Category');
        Yii::app()->CInfo->setTrue_delete_info('Category');
        Yii::app()->CInfo->setFalse_delete_info('Category');
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
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

    public function actionIndex()
    {
        $this->initJsIndexGeneret();
        $model = new Term();
        $model->unsetAttributes();
        if (isset($_GET['Term']))
            $model->attributes = $_GET['Term'];

        $this->render('index', array(
            'category' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Term();
        $this->performAjaxValidation($model);
        if (isset($_POST['Term'])) {
            $model->attributes = $_POST['Term'];
            $model->termTaxonomies = array(
                array(
                    'type' => 'category',
                    'parent' => $_POST['Term']['parent'],
                    'description' => $_POST['Term']['description'],
                    'status' => $_POST['Term']['status']
                )
            );
            if ($model->saveWithRelated('termTaxonomies')) {
                echo CJSON::encode(
                    array_merge(
                        Yii::app()->CInfo->getTrue_save_info(),
                        array(
                            'id' => $model->termTaxonomies[0]->id,
                            'name' => ucwords($model->name)
                        )
                    )
                );
                exit();
            } else {
                echo CJSON::encode(Yii::app()->CInfo->getFalse_save_info());
                exit();
            }
        } else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    public function actionUpdate($id)
    {

        $category = $this->loadModel($id);
        $this->performAjaxValidation($category);
        if (isset($_POST['Term'])) {
            $category->attributes = $_POST['Term'];
            $category->termTaxonomies = array(array('parent' => $_POST['Term']['parent'], 'description' => $_POST['Term']['description'], 'status' => $_POST['Term']['status']));
            $this->runSave($category->saveWithRelated('termTaxonomies'));
        } else
            $this->render('update', array('category' => $category));
    }

    public function actionQuikUpdate($id)
    {
        $category = $this->loadModel($id);
        $this->performAjaxValidation($category);
        if (isset($_POST['Term'])) {
            $category->attributes = $_POST['Term'];
            $this->runSave($category->save());
        } else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    public function actionDelete()
    {
        if (isset($_POST['id'])) {
            $cat_id = $this->loadModel($_POST['id'])->termTaxonomies[0]->id;
            $this->loadModel($_POST['id'])->delete();
            echo CJSON::encode(array_merge(Yii::app()->CInfo->getTrue_delete_info(), array('cat_id' => $cat_id)));
        } else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }


    public function loadModel($id)
    {
        $model = Term::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function initJsIndexGeneret()
    {
        Yii::app()->clientScript->registerScript('category-delete', '$(".delete-box").live("click", function(e) { var id = e.srcElement.className.split("id-"); $.msgbox("Are you sure that you want to permanently delete the selected element?", {type: "confirm", buttons: [{type: "submit", value: "Yes"}, {type: "submit", value: "No"}]}, function(result) { if (result === "Yes") { $.ajax({url: "' . Yii::app()->createUrl("dashboard/category/delete") . '", data: {id: id[1]}, dataType: "JSON", type: "POST"}).done(function(response) { $.msgGrowl({type: response.type, title: response.title, text: response.text}); $.fn.yiiGridView.update("category-grid"); $("#drop-category-list option[value=\'" + response.cat_id +"\']").remove(); }); } }); });', CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('form-category-quikupdate', '$("span.cat-quick-edit").live("click", function(e){ $(this).parent().parent().children().css("display","none");$(this).parent().parent().prepend(\'<td colspan="3" class="form-edit" ><div class="row-fluid"><h4>Quick Edit</h4><form method="POST" class="form-cat" action="' . Yii::app()->createUrl('dashboard/category/quikupdate', array('id' => '')) . '/\'+ $(this).attr("id") +\'"> <div class="control-group"><div class="controls"><input type="text" name="Term[name]" value="\'+  $(this).attr("name") +\'" class="span12" placeholder="Name" required></div></div><div class="control-group"><div class="controls"><input type="text" name="Term[slug]" value="\'+ $(this).attr("slug") +\'" class="span12" placeholder="Slug" required><input type="hidden" name="Term[parent]" value="\'+ $(this).attr("parent") +\'" ><input type="hidden" name="Term[status]" value="\'+ $(this).attr("status") +\'"></div></div><button type="button" class="cancel btn btn-small pull-left">Cencel</button> <button type="submit" class="update btn btn-small pull-right">Update Category</button></form></div></td>\');  });$("button.cancel").live("click", function() {$(this).parent().parent().parent().parent().children().css("display", ""); $(this).parent().parent().parent().remove(); }); $(".form-cat").live("submit", function() { $.ajax({url: $(this).attr("action"), data: $(this).serialize(), dataType: "JSON", type: "POST"}).done(function(response) { if (response.data === true) {$.msgGrowl({type: response.type, title: response.title, text: response.text});$.fn.yiiGridView.update("category-grid"); } else {$.msgGrowl({type: response.type, title: response.title, text: response.text}); } });return false; });', CClientScript::POS_READY);
    }

    protected function runSave($save)
    {
        if ($save) {
            echo CJSON::encode(Yii::app()->CInfo->getTrue_save_info());
            exit();
        } else {
            echo CJSON::encode(Yii::app()->CInfo->getFalse_save_info());
            exit();
        }
    }

}
