<?php

class SiteController extends ClientController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'guestbook.views.layouts.site.main';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact pages
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'foreColor' => 0x000000,
            ),
            // pages action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/pages&view=FileName
            'pages' => array(
                'class' => 'CViewAction',
            ),
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

    public function actionIndex() {
        $guestbook = new GuestBook();
        if (isset($_POST['GuestBook'])) {
            $guestbook->attributes = $_POST['GuestBook'];
            $guestbook->create_time = time();
            if ($guestbook->save()) {
//                $headers = "From: {$guestbook->email}\r\nReply-To: {$guestbook->email}";
//                mail(Yii::app()->params['adminEmail'], $guestbook->subject, "Website : " . $guestbook->web_url . '<br>' . $guestbook->content, $headers);
                Yii::app()->user->setFlash('guestbook', '<strong>Pesan Anda berhasil terkirim!</strong> Terima kasih telah menghubungi kami. Kami akan merespon anda sesegera mungkin.');
                $this->refresh();
            }
        }
        $this->render('index', array(
            'guestbook' => $guestbook,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = GuestBook::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'guest-book-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
