<?php
/**
 * Created by JetBrains PhpStorm.
 * User: melengo
 * Date: 10/20/13
 * Time: 2:53 AM
 * To change this template use File | Settings | File Templates.
 */

class NewsController extends ClientController
{
	public $layout = 'site.views.layouts.pages.main';
	protected $_model;
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

	public function actionIndex(){
			$this->unsetSession();
			$criteria = new CDbCriteria(array('order' => 'update_time DESC', 'with' => 'commentCount'));
			$criteria->condition = 'status="P"';
			$page = new CActiveDataProvider('Post', array(
				'pagination' => array(
					'pageSize' => Yii::app()->params['postsPerPage'],
				),
				'criteria' => $criteria,
			));
			$this->render('index', array(
				'layouts' => 1,
				'pages' => $page,
			));
	}

	public function actionView() {
		if (isset($_GET['slug'])) {
			$this->unsetSession();
			$page = $this->loadPageSlug();
			$this->render('view', array(
				'layouts' => 1,
				'comment' => $page->newComment($page),
				'pages' => $page,
			));
		}
		else
			throw new CHttpException(404, 'The requested pages does not exist.');
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
		unset(Yii::app()->session['menu']);
		return true;
	}
}