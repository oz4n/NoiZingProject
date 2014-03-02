<?php

class CommentController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//    public $layout = 'dashboard.views.layouts.main';
    private $_model;

    public function init() {
        parent::init();
        $model = Comment::model()->findAll();
        
        Yii::app()->clientScript->registerScript('popover-id', "$('#post-title').popover('show')", CClientScript::POS_READY);
        foreach ($model as $v) {
            Yii::app()->clientScript->registerScript('script-del-' . $v->id, "$('body').on('click', '#delete-com-$v->id',function () { " . '
                $.msgbox("Are you sure that you want to permanently delete the selected element?", {
                type: "confirm", 
                buttons : [ 
                {
                    type: "submit",
                    value: "Yes"
                    }, {
                    type: "submit",
                    value: "No"
                }
                ] }, 
                function(result) {
                if(result === "Yes"){
                    ' . "jQuery.ajax({
                        'type':'POST',
                        'url':'" . Yii::app()->request->hostInfo . Yii::app()->baseUrl . "/index.php/dashboard/comment/delete',
                            'cache':false,
                            'data':{id:'$v->id'},
                                success:function(){
                                $.fn.yiiGridView.update('comment-grid'); 
                                }
                                }); " . '
                                    }else{
                                    console.log("gagal")} 
                                    }); ' . " 
                                        });", CClientScript::POS_READY);
            Yii::app()->clientScript->registerScript('script-rp-' . $v->id, '$("body").on("click","#reply-' . $v->id . '",function(){ if($("#fomr-rp-' . $v->id . '").is(":hidden")){ $("#fomr-rp-' . $v->id . '").slideDown(200); }else{ $("#fomr-rp-' . $v->id . '").slideUp(200); } });', CClientScript::POS_READY);
        }
    }

    public function actions() {
        parent::actions();
        return array(
            'message.' => 'dashboard.components.notification.ENotification',
        );
    }

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('morecomments', 'approve', 'dashboard', 'create', 'list', 'update', 'delete', 'deleteall', 'index', 'view', 'replay', 'message.msg'),
                'expression' => '$user->isAdministrator()',
            ),
            array('deny',
                'users' => array('*'),
            )
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' pages.
     */
    public function actionCreate() {
        $model = new Comment;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Comment'])) {
            $model->attributes = $_POST['Comment'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' pages.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Comment'])) {
            $model->attributes = $_POST['Comment'];
            if ($model->save())
                echo CJSON::encode(array('sucsess' => true));
//                $this->redirect(array('view', 'id' => $model->id));
        }

//        $this->render('update', array(
//            'model' => $model,
//        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'dashboard' pages.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete() {
//        print_r($_POST);
        Comment::model()->findByPk($_POST['id'])->delete();
        echo CJSON::encode(array("data" => 'berhasil'));
//        $this->loadModel($_POST['id'])->delete();
        // if AJAX request (triggered by deletion via dashboard grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('dashboard'));
    }

    public function actionIndex() {
        $model = new Comment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Comment']))
            $model->attributes = $_GET['Comment'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
//    public function actionIndex() {
//        $dataProvider = new CActiveDataProvider('Comment',array(
//            'pagination' => array('pageSize' => 2),
//        ));
//        $this->render('index', array(
//            'dataProvider' => $dataProvider,
//        ));
//    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Comment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Comment']))
            $model->attributes = $_GET['Comment'];

        $this->render('dashboard', array(
            'model' => $model,
        ));
    }

    public function actionApprove() {
        if (Yii::app()->request->isPostRequest) {
            $comment = $this->loadModel();
            $comment->approve();
            echo json_encode(array('data' => "sassa"));
//            $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionReplay() {
        $model = new Comment;
        if (isset($_POST['Comment'])) {
            $account = Account::model()->findAccount();
            $model->author = $account->username;
            $model->email = $account->email;
            $model->status = 'P';
            $model->content = $_POST['Comment']['content'];
            $model->parent_replay = $_POST['Comment']['parent_replay'];
            $model->post_id = $_POST['Comment']['post_id'];
            $model->url = Yii::app()->request->hostInfo;
            $model->save();
            $data = '<div class="media media-msg-id-' . $model->id . '" style="font-weight: normal;">' .
                    '<a class="pull-left" href="' . $model->url . '">' .
                    Yii::app()->gravatar->getGravatar($model->email, 20) .
                    '</a>' .
                    '<b>'
                    . CHtml::link('<i class="icon-user"></i>'.$model->author, $model->url) .
                    ' | <i class="icon-calendar"></i>' . date("D, M t, Y", time()) .
                    '</b>' .
                    '<div class="media-body">' .
                    '<p style="text-align: justify;" id="content-' . $model->id . '">' . $model->content . '</p>' .
                    CHtml::link("<i class='icon-pencil'></i>Edit", "", array("id" => "edit-message-$model->id", "style" => "cursor: pointer; color:#57af57;",
                        'onclick' => "EditFadein($model->id,$model->parent_replay)")) .
                    "<i style='color:#000;'> |</i> " .
                    CHtml::link("<i class='icon-remove'></i>Delete", "", array('id' => "delete-message-$model->id", "style" => 'cursor: pointer; color:#ee5f5b;',
                        'onclick' => "DeleteMSG($model->id)")) .
                    '</div>' .                    
                    '<div id="form-replay-' . $model->id . '" style="display:none;">' .
                    '<form id="form-action-' . $model->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/update/id/' . $model->id . '">' .
                    CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $model->id)) .
                    CHtml::hiddenField('Comment[post_id]', $model->post_id) .
                    CHtml::link('Update', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-edit-' . $model->id,
                        'onclick' => "EditSubmit($model->id)")) . " " .
                    CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $model->id,
                        'onclick' => "CencelBooton($model->id)")) .
                    '<div id="loading-submit"></div>' .
                    '</form>' .
                    '</div>'.
                    '</div>'
            ;
            echo CJSON::encode(array('html' => $data));
        }else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Comment::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested pages does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
