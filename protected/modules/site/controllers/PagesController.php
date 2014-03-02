<?php

class PagesController extends ClientController
{

	public $layout = 'site.views.layouts.pages.main';
	private $_model;

	public function actions()
	{
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

	public function actionIndex()
	{
		if (isset($_GET['menu'])) {
			$this->unsetSession();
			$criteria = new CDbCriteria(array('order' => 'update_time DESC', 'with' => 'commentCount'));
			$criteria->condition = 'status="P"';
			$criteria->addSearchCondition('pages_slug', $_GET['menu']);
			$page = new CActiveDataProvider('Post', array(
				'pagination' => array(
					'pageSize' => Yii::app()->params['postsPerPage'],
				),
				'criteria' => $criteria,
			));
			$this->render('index', array(
				'layouts' => 1,
				'pagemenu' => $this->loadMenuSlug(),
				'pages' => $page,
			));
		} else
			throw new CHttpException(404, 'The requested pages does not exist.');
	}


	public function actionView()
	{
		if (isset($_GET['menu']) && isset($_GET['slug'])) {
			$this->unsetSession();
			$pages = $this->loadPageSlug();
			$this->render('view', array(
				'layouts' => 1,
				'comment' => $pages->newComment($pages),
				'pages' => $pages,
			));
		} else
			throw new CHttpException(404, 'The requested pages does not exist.');
	}


	private function loadMenuSlug()
	{
		if ($this->_model === null) {
			if (isset($_GET['menu'])) {
				$this->_model = NavMenu::model()->findByAttributes(array('slug' => $_GET['menu']));
			}
			if ($this->_model === null)
				throw new CHttpException(404, 'The requested pages does not exist.');
		}
		return $this->_model;
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

	/*
	 * Membersihkan session category dan menu
	 */
	protected function unsetSession()
	{
		unset(Yii::app()->session['category']);
		unset(Yii::app()->session['tag']);
		return true;
	}




//    public function actionTest() {
//        $text = 'https://www.localhost/yii-ebook';
//        preg_match('%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i', $text, $matches);
//        CVarDumper::dump($matches, 100, true);
//    }


}
