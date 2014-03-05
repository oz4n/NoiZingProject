<?php

class MenuController extends AdminController
{

    public function init()
    {
        parent::init();

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgbox/jquery.msgbox.min.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/css/msgGrowl.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/msgGrowl/js/msgGrowl.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/plugins/nestable/jquery.nestable.js', CClientScript::POS_END);

        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/app/MenuController.js', CClientScript::POS_END);

        Yii::app()->CInfo->setTrue_save_info('Menu');
        Yii::app()->CInfo->setFalse_save_info('Menu');
        Yii::app()->CInfo->setTrue_delete_info('Menu');
        Yii::app()->CInfo->setFalse_delete_info('Menu');
    }

    public function actionTes()
    {
        $a = $this->findPositionByParentID(9, 4);
        echo $a->position;
    }

    public function findPositionByParentID($parent_id, $position)
    {
        $model = NavMenu::model()->find('parent=' . $parent_id . ' && ' . 'position=' . $position);
        return $model;
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );

    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
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

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        Yii::app()->clientScript->registerScript('MenuParentDeleteUrl', 'var ParentMenuActionDelete = "' . Yii::app()->createUrl("dashboard/menu/parentdelete") . '";', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScript('MenuIndex', "
            MenuController.initDeleteParentMenu();
            MenuController.initMenuActive();
        ", CClientScript::POS_READY);
        $this->initJsIndexGeneret();
        $model = new Term;
        $model->unsetAttributes();
        if (isset($_GET['Term']))
            $model->attributes = $_GET['Term'];

        $this->render('index', array(
            'navmenu' => $model,
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
                    'type' => 'nav_menu',
                    'parent' => 0,
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionTest()
    {
        $data = json_decode($_POST['data'], true, 64);
        foreach ($this->parseJsonArray($data) as $key => $v) {
            $model = $this->loadModel($v['id']);
            $model->position = $key;
            $model->parent = $v['parent'];
            $model->save();
        }
//        print_r($this->parseJsonArray($data));
    }

    private function parseJsonArray($jsonArray, $parentID = 0)
    {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray['children'])) {
                $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
            }
            $return[] = array('id' => $subArray['id'], 'parent' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

    public function actionAddPageToMenu()
    {
        if (isset($_POST['NavMenu']['termTaxonomy'])) {
            $d = $_POST['NavMenu']['termTaxonomy'];
            for ($i = 0; $i < count($d); $i++) {
                $m = TermTaxonomy::model()->findByPk($d[$i]);
                $navmenu = new NavMenu;
                $navmenu->name = $m->term->name;
                $navmenu->slug = $m->term->slug;
                $navmenu->parent = 0;
                $navmenu->position = 0;
                $navmenu->term_id = $m->term_id;
                $navmenu->term_taxonomy_id = 1; //Foreign key
                $navmenu->save();
            }
            echo CJSON::encode(Yii::app()->CInfo->getTrue_save_info());
        } else
            echo CJSON::encode(Yii::app()->CInfo->getFalse_save_info());
    }

    public function actionAddCatToMenu()
    {
        if (isset($_POST['NavMenu']['termTaxonomy'])) {
            $d = $_POST['NavMenu']['termTaxonomy'];
            $term_taxonomy_id = $_POST['NavMenu']['term_taxonomy_id'];

            for ($i = 0; $i < count($d); $i++) {
                $m = TermTaxonomy::model()->findByPk($d[$i]);
                $navmenu = new NavMenu;
                $navmenu->name = $m->term->name;
                $navmenu->slug = $m->term->slug;
                $navmenu->parent = 0;
                $navmenu->position = 0;
                $navmenu->term_id = $m->term_id;
                $navmenu->term_taxonomy_id = $term_taxonomy_id; //Foreign key
                $navmenu->save();
            }
            echo CJSON::encode(Yii::app()->CInfo->getTrue_save_info());
        } else
            echo CJSON::encode(Yii::app()->CInfo->getFalse_save_info());
    }

    public function actionParentDelete($id)
    {
        $cat_id = $this->loadTermModel($id)->termTaxonomies[0]->id;
        $this->loadTermModel($id)->delete();
        echo CJSON::encode(array_merge(Yii::app()->CInfo->getTrue_delete_info(), array('cat_id' => $cat_id)));

    }


    public function loadTermModel($id)
    {
        $model = Term::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }

    protected function loadNavMenuTaxonomy($id)
    {
        $model = NavMenuTaxonomy::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' pages.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $my_position = $model->position;
        if (isset($_POST['NavMenu'])) {
            $model->attributes = $_POST['NavMenu'];
            $old = $this->findPositionByParentID($_POST['NavMenu']['parent'], $_POST['NavMenu']['position']);
            $old->position = $my_position;
            $old->save();
            $this->runSave($model->save());
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete()
    {
        if (isset($_POST)) {
            $menu_id = $this->loadModel($_POST['id'])->id;
            $this->loadModel($_POST['id'])->delete();
            echo CJSON::encode(array_merge(Yii::app()->CInfo->getTrue_delete_info(), array('cat_id' => $menu_id)));
        } else
            throw new CHttpException(404, 'The requested pages does not exist.');
    }

    public function actionSelect($id)
    {
        $this->initJsIndexGeneret();
        Yii::app()->clientScript->registerScript('MenuController', "MenuController.init();", CClientScript::POS_READY);
        $model = new NavMenu('search');
        $model->unsetAttributes();
        $navmenu = new NavMenu();


        $term = $this->loadTermTaxonomyModel($id);
        if (isset($_GET['NavMenu']))
            $model->attributes = $_GET['NavMenu'];

        $this->render('select', array(
            'model' => $model,
            'navmenu' => $navmenu,
            'term' => $term
        ));

    }


    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new NavMenu('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['NavMenu']))
            $model->attributes = $_GET['NavMenu'];

        $this->render('dashboard', array(
            'model' => $model,
        ));
    }

    public function loadTermTaxonomyModel($term_id)
    {
        $model = TermTaxonomy::model()->findByPk($term_id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = NavMenu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function initJsIndexGeneret()
    {
//        Yii::app()->clientScript->registerScript('category-delete', '
//        $(".delete-box").live("click", function(e) {
//            var id = $(this).attr("data-id");
//            $.msgbox("Are you sure that you want to permanently delete the selected element?",
//                {
//                    type: "confirm",
//                    buttons: [{type: "submit", value: "Yes"}, {type: "submit", value: "No"}]
//                }, function(result) {
//                    if (result === "Yes") {
//                        $.ajax({
//                            url: "' . Yii::app()->createUrl("dashboard/menu/delete") . '",
//                            data: {id: id[1]},
//                            dataType: "JSON",
//                            type: "POST"
//                        }).done(
//                            function(response) {
//                                $.msgGrowl({
//                                    type: response.type,
//                                    title: response.title,
//                                    text: response.text
//                                });
//                                $.fn.yiiGridView.update("category-grid");
//                                $("#drop-category-list option[value=\'" + response.cat_id +"\']").remove();
//                            }
//                        );
//                    } }); });', CClientScript::POS_READY);
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
