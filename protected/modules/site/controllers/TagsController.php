<?php
/**
 * Created by JetBrains PhpStorm.
 * User: melengo
 * Date: 10/13/13
 * Time: 7:58 PM
 * To change this template use File | Settings | File Templates.
 */

class TagsController extends ClientController
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

	/*
	 * Menampilkan semua post Berdasarkan tags
	 */
	public function actionIndex()
	{
		if (isset($_GET['tag'])) {
			$this->unsetSession();
			$criteria = new CDbCriteria(array('order' => 'update_time DESC', 'with' => 'commentCount'));
			$criteria->condition = 'status="P"';
			$criteria->addSearchCondition('tags', $_GET['tag']);
			$tags = new CActiveDataProvider('Post', array(
				'pagination' => array(
					'pageSize' => Yii::app()->params['postsPerPage'],
				),
				'criteria' => $criteria,
			));
			$this->render('index', array(
				'layouts' => 1,
				'tags' => $tags
			));
		} else
			throw new CHttpException(404, 'The requested pages does not exist.');
	}

	/*
	 * Menampilkan 1 post berdasarkan tag dan Slug
	 */
	public function actionView()
	{
		if (isset($_GET['tag']) && isset($_GET['slug'])) {
			$this->unsetSession();
			$tags = $this->loadPageSlug();
			$this->render('view', array(
				'layouts' => 1,
				'comment' => $tags->newComment($tags),
				'tags' => $tags
			));
		} else
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
	private function unsetSession()
	{
		unset(Yii::app()->session['category']);
		unset(Yii::app()->session['menu']);
		return true;
	}
}