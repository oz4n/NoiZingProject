<?php

class DefaultController extends ClientController {

    public $pageTitle = 'Black Holes!';
	private $_model;
    public function actionTest() {
       $model = Post::model()->findByPk(1);       
       $html_split = new IMachTagHtml();       
       echo implode(",", $html_split->getImgFileUidMachAll($model->content));
//        $x = 200;
//        $y = 200;
//
//        $gd = imagecreatetruecolor($x, $y);
//
//        $corners[0] = array('x' => 100, 'y' => 10);
//        $corners[1] = array('x' => 0, 'y' => 190);
//        $corners[2] = array('x' => 200, 'y' => 190);
//
//        $red = imagecolorallocate($gd, 255, 0, 0);
//
//        for ($i = 0; $i < 100000; $i++) {
//            imagesetpixel($gd, round($x), round($y), $red);
//            $a = rand(0, 2);
//            $x = ($x + $corners[$a]['x']) / 2;
//            $y = ($y + $corners[$a]['y']) / 2;
//        }
//
//        header('Content-Type: image/png');
//        imagepng($gd);
//        $ix = 200;
//        $iy = 200;
//
//        $GDimage = imagecreatetruecolor($ix, $iy);
//        $red = imagecolorallocate($GDimage, 255, 0, 0); 
//        $circleRadius = 70;
//        $offsetX = 100;
//        $offsetY = 100;
//        
//        for ($i = 0; $i <= 360; ++$i) {
//            $x = round(cos($i * M_PI / 120) * $circleRadius);
//            $y = round(sin($i * M_PI / 120) * $circleRadius);
//
//            // Draw some pixel, or do something else here.
//            imagesetpixel($GDimage, $x + $offsetX, $y + $offsetY, $red);
//        }
//        header('Content-Type: image/png');
//        imagepng($GDimage);
    }

	public function actionViewPermalink() {
		$this->layout = 'site.views.layouts.pages.main';
		if (isset($_GET['link']) && isset($_GET['slug'])) {
			$page = $this->loadPageSlug();
			$this->subPageTitle = ucwords($_GET['link']);
			$this->breadcrumbs = array('separator' => '<i class="icon-angle-right"></i>', 'htmlOptions' => array('class' => 'pull-right'), 'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')), 'links' => array(ucwords($_GET['link']) => Yii::app()->createUrl('/site/pages/index', array('link' => $_GET['link'])), ucwords($page->title)));
			$layouts = 1;
			$this->render('view', array(
				'layouts' => $layouts,
				'pages' => $page,
			));
		}
		else
			throw new CHttpException(404, 'The requested pages does not exist.');
	}




	public function actionIndex() {
        unset(Yii::app()->session['category']);
        unset(Yii::app()->session['tag']);
        unset(Yii::app()->session['menu']);
        $this->new_post = true;
        $this->layout = 'site.views.layouts.default.main';
        $this->subPageTitle = 'Headline News';
        $criteria = new CDbCriteria(array(
            'with' => array('commentCount'),
            'order' => 'create_time DESC',
            'condition' => "status='P' && post_status='info'",
        ));
        $posts = Post::model()->findAll($criteria);
        $dataProvider = new CArrayDataProvider($posts, array(
            'pagination' => array(
                'pageSize' => 12,
            ),
        ));
        $this->render('index', array(
            'post' => $posts,
        ));
    }

	/*
	 * Mengambil data Post berdasarkan slug (URL Title)
	 */
	private function loadPageSlug()
	{
		if ($this->_model === null) {
			if (isset($_GET['slug'])) {
				$this->_model = Post::model()->findByAttributes(array('slug' => $_GET['slug']));
			}
			if ($this->_model === null)
				throw new CHttpException(404, 'The requested pages does not exist.');
		}
		return $this->_model;
	}

    public function actionBranch() {
        $this->layout = 'site.views.layouts.management.main';
        $this->breadcrumbs = array(
            'separator' => '<i class="icon-angle-right"></i>',
            'htmlOptions' => array('class' => 'pull-right'),
            'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
            'links' => array(
                'Manajement Cabang'
        ));
        $this->subPageTitle = 'Manajement Cabang';
        $this->pageTitle = 'Manajement Cabang';
        $branch = new Management();
        $this->render('../management/branch', array(
            'branch' => $branch
        ));
    }

    public function actionCentral() {
        $this->layout = 'site.views.layouts.management.main';
        $this->breadcrumbs = array(
            'separator' => '<i class="icon-angle-right"></i>',
            'htmlOptions' => array('class' => 'pull-right'),
            'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
            'links' => array(
                'Manajement Pusat'
        ));
        $this->subPageTitle = 'Manajement Pusat';
        $this->pageTitle = 'Manajement Pusat';
        $central = new Management();
        $this->render('../management/central', array(
            'central' => $central
        ));
    }

    public function actionLogin() {
        $this->layout = 'site.views.layouts.login.main';
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous pages if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionError() {
        $this->layout = 'site.views.layouts.login.main';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}