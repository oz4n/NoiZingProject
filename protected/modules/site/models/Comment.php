<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property string $author
 * @property string $email
 * @property string $url
 * @property string $content
 * @property string $status
 * @property integer $create_time
 * @property integer $parent_replay
 * @property integer $like
 * @property integer $unlike
 * @property string $country
 * @property string $ip_buplic
 * @property integer $post_id
 * @property string $verifyCode
 *
 * The followings are the available model relations:
 * @property Post $post
 */
class Comment extends CActiveRecord
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author, email, content, post_id', 'required'),
			array('create_time, parent_replay, like, unlike, post_id', 'numerical', 'integerOnly' => true),
			array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
			array('author, email, url', 'length', 'max' => 128),
			array('status', 'length', 'max' => 1),
			array('country', 'length', 'max' => 45),
			array('ip_buplic', 'length', 'max' => 40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, author, email, url, content, status, create_time, parent_replay, like, unlike, country, ip_buplic, post_id', 'safe', 'on' => 'search'),
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
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author' => 'Author',
			'email' => 'Email',
			'url' => 'Url',
			'content' => 'Content',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'parent_replay' => 'Parent Replay',
			'like' => 'Like',
			'unlike' => 'Unlike',
			'country' => 'Country',
			'ip_buplic' => 'Ip Buplic',
			'post_id' => 'Post',
		);
	}

	/**
	 * @return integer the number of comments that are pending approval
	 */
	public function getPendingCommentCount() {
		return $this->count("status='D'");
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function findAllByPostID($post_id, $parent=0,$status="P")
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;
		$criteria->condition = "(post_id=$post_id AND parent_replay=$parent) AND status='$status'";
		$criteria->order = "create_time";
		return self::model()->findAll($criteria);
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
		$criteria->compare('author', $this->author, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('create_time', $this->create_time);
		$criteria->compare('parent_replay', $this->parent_replay);
		$criteria->compare('like', $this->like);
		$criteria->compare('unlike', $this->unlike);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('ip_buplic', $this->ip_buplic, true);
		$criteria->compare('post_id', $this->post_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}