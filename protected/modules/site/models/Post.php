<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string $tags
 * @property string $pages_slug
 * @property string $status
 * @property string $icon
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $like
 * @property integer $unlike
 * @property string $shares
 * @property string $comment_status
 * @property integer $post_view
 * @property string $post_status
 * @property string $files_uid
 * @property string $cron_checked
 * @property integer $account_id
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property commentCount $commentCount
 * @property Account $account
 * @property TermTaxonomy[] $termTaxonomies
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status, account_id', 'required'),
			array('create_time, update_time, like, unlike, post_view, account_id', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 128),
			array('status, comment_status, cron_checked', 'length', 'max' => 1),
			array('shares, post_status', 'length', 'max' => 5),
			array('slug, tags, pages_slug, icon, files_uid', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, slug, tags, pages_slug, status, icon, create_time, update_time, like, unlike, shares, comment_status, post_view, post_status, files_uid, cron_checked, account_id', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'post_id'),
			'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition' => "status= 'P'"),
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'termTaxonomies' => array(self::MANY_MANY, 'TermTaxonomy', 'relationships(post_id, term_taxonomy_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'slug' => 'Slug',
			'tags' => 'Tags',
			'pages_slug' => 'Pages Slug',
			'status' => 'Status',
			'icon' => 'Icon',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'like' => 'Like',
			'unlike' => 'Unlike',
			'shares' => 'Shares',
			'comment_status' => 'Comment Status',
			'post_view' => 'Post View',
			'post_status' => 'Post Status',
			'files_uid' => 'Files Uid',
			'cron_checked' => 'Cron Checked',
			'account_id' => 'Account',
		);
	}

	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	protected function addComment($comment)
	{
		$comment->create_time = time();
		$comment->status="D";
		$comment->post_id=$this->id;
		return $comment->save();
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	public function newComment($post)
	{
		$comment = new Comment;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if (isset($_POST['Comment'])) {
			$comment->attributes = $_POST['Comment'];
			if ($this->addComment($comment)) {
				if ($comment->status == 'D')
					Yii::app()->user->setFlash('commentSubmitted', '<strong>Thank you for your comment.</strong> Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}


	public function getUrl()
	{
		if (Yii::app()->session['menu'] != null) {
			return Yii::app()->createUrl('site/pages/view', array(
				'menu' => Yii::app()->session['menu'],
				'slug' => $this->slug,
			));
		} else if (Yii::app()->session['tag'] != null) {
			return Yii::app()->createUrl('site/tags/view', array(
				'tag' => Yii::app()->session['tag'],
				'slug' => $this->slug,
			));
		} else if (isset(Yii::app()->session['category'])) {
			return Yii::app()->createUrl('site/categories/view', array(
				'category' => Yii::app()->session['category'],
				'slug' => $this->slug,
			));
		} else {
			return Yii::app()->createUrl('site/news/view', array(
				'slug' => $this->slug,
			));
		}
	}

	public function getImgLink()
	{
		$html_split = new IMachTagHtml();
		return $html_split->getImgMach($this->content, Yii::app()->params['img']['default_img']);
	}

	public function getNewsLink()
	{
		return Yii::app()->createUrl('site/default/new', array(
			'slug' => $this->slug,
		));
	}

	public function getPermalink()
	{
		return Yii::app()->createUrl('site/pages/viewpermalink', array(
			'link' => Yii::app()->session['menu'],
			'year' => date('Y', $this->update_time),
			'month' => date('d', $this->update_time),
			'slug' => strtolower($this->slug),
		));
	}

	public function getTagLinks()
	{
		$links = array();
		foreach (Tag::string2array($this->tags) as $tag)
			$links[] = CHtml::link(CHtml::encode("#" . $tag), array('/site/tags/index', 'tag' => strtolower($tag)), array("rel" => "tooltip", "data-original-title" => CHtml::encode("#" . $tag) . " tag"));
		return $links;
	}

	public function catLinks($id, $cats = array())
	{
		foreach (TermTaxonomy::model()->getCategoryNameByPostID($id) as $cat)
			$cats[] = CHtml::link(CHtml::encode($cat["name"]), array('/site/categories/index', 'category' => strtolower($cat["slug"])), array("rel" => "tooltip", "data-original-title" => $cat["name"] . " category"));
		return $cats;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('tags', $this->tags, true);
		$criteria->compare('pages_slug', $this->pages_slug, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('icon', $this->icon, true);
		$criteria->compare('create_time', $this->create_time);
		$criteria->compare('update_time', $this->update_time);
		$criteria->compare('like', $this->like);
		$criteria->compare('unlike', $this->unlike);
		$criteria->compare('shares', $this->shares, true);
		$criteria->compare('comment_status', $this->comment_status, true);
		$criteria->compare('post_view', $this->post_view);
		$criteria->compare('post_status', $this->post_status, true);
		$criteria->compare('files_uid', $this->files_uid, true);
		$criteria->compare('cron_checked', $this->cron_checked, true);
		$criteria->compare('account_id', $this->account_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}