<?php

class AccountController extends AdminController {

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
        Yii::app()->clientScript->registerScript('account-list', "$('ul.nav > li.accounts-list').addClass('active')", CClientScript::POS_READY);
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('accounts','dashboard', 'create', 'list', 'update', 'delete', 'deleteall', 'index', 'view'),
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
        $account = new Account;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($account);

        if (isset($_POST['Account'])) {
            $account->attributes = $_POST['Account'];            
            if ($account->save())               
                $this->redirect(array('view', 'id' => $account->id));
        }

        $this->render('create', array(
            'account' => $account,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' pages.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $account = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($account);

        if (isset($_POST['Account'])) {
            $account->attributes = $_POST['Account'];
            if ($account->save())
                $this->redirect(array('view', 'id' => $account->id));
        }

        $this->render('update', array(
            'account' => $account,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'dashboard' pages.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via dashboard grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('dashboard'));
    }

    /**
     * Lists all Account models.
     */
    public function actionAccounts() {
        $accounts = new Account('search');
        $accounts->unsetAttributes();
        if (isset($_GET['Account']))
            $accounts->attributes = $_GET['Account'];

        $this->render('index', array(
            'accounts' => $accounts,
        ));
    }
    
    public function actionIndex() {
        $accounts = new Account('search');
        $accounts->unsetAttributes();
        if (isset($_GET['Account']))
            $accounts->attributes = $_GET['Account'];

        $this->render('index', array(
            'accounts' => $accounts,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Account('search');
        $model->unsetAttributes(); 
        if (isset($_GET['Account']))
            $model->attributes = $_GET['Account'];

        $this->render('dashboard', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Account::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'account-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
