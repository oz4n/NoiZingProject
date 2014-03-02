<?php

/**
 * Created by JetBrains PhpStorm.
 * User: melengo
 * Date: 10/14/13
 * Time: 11:24 AM
 * To change this template use File | Settings | File Templates.
 */
class SearchesController extends ClientController
{

	public $layout = 'site.views.layouts.pages.main';
	private $_model;
	public $_indexFiles = 'runtime.search.post';

	public function init()
	{
		Yii::import('application.vendors.*');
		require_once('Zend/Search/Lucene.php');
		parent::init();
	}

//	public function actionIndex()
//	{
//		if (isset($_POST['key'])) {
//			$this->unsetSession();
//			Yii::app()->session['search'] = $_POST['key'];
//		}
//		if (isset(Yii::app()->session['search'])) {
//			$criteria = new CDbCriteria(array('order' => 'update_time DESC', 'with' => 'commentCount'));
//			$criteria->condition = "status='P'";
//			$criteria->compare('pages_slug', explode(",", Yii::app()->session['search']), true);
////			$criteria->compare('tags', explode(",", Yii::app()->session['search']), true, 'AND', true);
//			$page = new CActiveDataProvider('Post', array(
//				'pagination' => array(
//					'pageSize' => Yii::app()->params['postsPerPage'],
//				),
//				'criteria' => $criteria,
//			));
//			$this->render('index', array(
//				'layouts' => 1,
//				'tags' => $page,
//			));
//		} else
//			throw new CHttpException(404, 'The requested pages does not exist.');
//	}

	public function actionIndex()
	{
		if (($term = Yii::app()->getRequest()->getParam('key', null)) !== null) {
			$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
			$results = $index->find($term);
			$query = Zend_Search_Lucene_Search_QueryParser::parse($term);
			$page = new CPagination(count($results));
			$page->pageSize = 5;
			$dataProvider = new CArrayDataProvider($results, array(
					'keyField' => 'id',
					'totalItemCount' => count($results),
					'pagination' => array(
						'pageSize' => 5,
					),
				)
			);

			$this->render('index', compact('dataProvider', 'results', 'term', 'query', 'page'));
		} else
			throw new CHttpException(404, 'The requested pages does not exist.');
	}

	public function actionCreate()
	{
		$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);

		$posts = Post::model()->findAll();
		foreach ($posts as $post) {
			$doc = new Zend_Search_Lucene_Document();
			$doc->addField(Zend_Search_Lucene_Field::Text('id', $post->id, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('title', CHtml::encode($post->title), 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('url', $post->url, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('content', $post->content, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('tags', CHtml::encode($post->tags), 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('pages_slug', CHtml::encode($post->pages_slug), 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('post_status', $post->post_status, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('create_time', $post->create_time, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('username', $post->account->username, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('email', $post->account->email, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('commentCount', $post->commentCount, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('catlinks', implode(", ", $post->catlinks($post->id)), 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('taglinks', implode(", ", $post->taglinks), 'utf-8'));
			$index->addDocument($doc);
		}
		$index->commit();
		echo 'Lucene index created';
	}

	public function actionView()
	{

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
		unset(Yii::app()->session['tag']);
		unset(Yii::app()->session['menu']);
		return true;
	}

}
