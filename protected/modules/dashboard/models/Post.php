<?php

/**
 * This is the model class for table "Post".
 *
 * The followings are the available columns in table 'Post':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string $tags
 * @property string $pages_slug
 * @property string $status
 * @property integer $post_view
 * @property string $icon
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $like
 * @property integer $unlike
 * @property string $comment_status
 * @property string $post_status
 * @property string $files_uid
 * @property string $cron_checked
 * @property integer $account_id
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Account $account
 * @property TermTaxonomy[] $termTaxonomies
 * @property CSaveRelationsBehavior[] $CSaveRelationsBehavior
 */
class Post extends CActiveRecord {

    private $_table = 'post';
    private $_oldTags;
    public $categoryIds;
    public $page;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return $this->_table;
    }

    public function behaviors() {
        return array(
            'CSaveRelationsBehavior' => array('class' => 'dashboard.components.behaviors.CSaveRelationsBehavior'),
            'sluggable' => array(
                'class' => 'ext.behaviors.SluggableBehavior',
                'columns' => array('title'),
                'unique' => true,
                'update' => true,
            ),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, content, status', 'required'),
            array('post_view, create_time, update_time, like, unlike, account_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 128),
            array('status, comment_status, cron_checked', 'length', 'max' => 1),
            array('post_status', 'length', 'max' => 8),
            array('slug, tags, pages_slug, icon, files_uid', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, content, slug, tags, pages_slug, status, post_view, icon, create_time, update_time, like, unlike, comment_status, post_status, files_uid, cron_checked, account_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'termTaxonomies' => array(self::MANY_MANY, 'TermTaxonomy', 'relationships(post_id, term_taxonomy_id)'),
            'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition' => "comments.status= 'P'", 'order' => 'comments.create_time DESC'),
            'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition' => "status= 'P'"),
            'categories' => array(self::MANY_MANY, 'Category', 'relationships(post_id, term_taxonomy_id)'),
            'categoriesCount' => array(self::STAT, 'Category', 'relationships(post_id, term_taxonomy_id)', 'condition' => "type= 'category'"),
            'pages' => array(self::MANY_MANY, 'Page', 'relationships(post_id, term_taxonomy_id)'),
            'pageCount' => array(self::STAT, 'Page', 'relationships(post_id, term_taxonomy_id)', 'condition' => "type= 'pages'"),
            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'slug' => 'Slug',
            'tags' => 'Tags',
            'pages_slug' => 'Pages Slug',
            'status' => 'Status',
            'post_view' => 'Post view',
            'icon' => 'Icon',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'like' => 'Like',
            'unlike' => 'Unlike',
            'comment_status' => 'Comment Status',
            'post_status' => 'Post Status',
            'files_uid' => 'Files Uid',
            'cron_checked' => 'Cron Checked',
            'account_id' => 'Account',
        );
    }

    public function getPage() {
        return $this->page;
    }

    public function setPage($page = array()) {
        $data = array();
        foreach ($page as $v) {
            $data[] = TermTaxonomy::model()->find('id=' . $v)->term->slug;
        }
        $this->page = $data;
        return $this;
    }

    public function afterFind() {
        $this->categoryIds = array_keys($this->categories);
        $this->_oldTags = $this->tags;
        parent::afterFind();
    }
    
     public function category($id,$cats = array()) {                
        foreach (Category::model()->getCategoryNameByPostID($id) as $cat)
            $cats[] = CHtml::link(CHtml::encode($cat["name"]), array('/site/pages/index', 'category' => strtolower($cat["slug"])));
        return implode(',', $cats);
    }
    
   

    public function postCountById($id) {
        $model = self::model()->find("id=" . $id);
        return $model['post_view'];
    }

    public function getTagLinks() {
        $links = array();
        foreach (Tag::string2array($this->tags) as $tag)
            $links[] = CHtml::link(CHtml::encode($tag), array('articels/index', 'tag' => strtolower($tag)));
        return $links;
    }

    public function getUrl() {
        return Yii::app()->createUrl('site/articels/view', array(
                    'slug' => $this->slug,
        ));
    }

    public function getArticelTitle($id, $url, $date, $title, $status) {
        echo '<div class="media">';
        //  echo CHtml::link(CHtml::image(Yii::app()->baseUrl . Yii::app()->getParams()->data['articel']['thumbnails'] . '60x60/default.png', "", array("class" => "media-object img-polaroid")), $url, array("class" => 'pull-left'));       
        echo '<div class="media-body">';
        echo '<h5 class="media-heading">' . CHtml::link($title, $url) . '</h5>';
        echo '<p>' . Lookup::item("PostStatus", $status) . ' on ' . date('d F Y', $date) . '</p>';
        echo '<p style="margin-top:-15px;">' . CHtml::link("Edit", array("post/update/id/" . $id)) . ' | ' . CHtml::link("Delete", array("post/delete/id/" . $id)) . ' | ' . CHtml::link("View", "#") . '</p>';
        echo '</div>';
        echo '</div>';
    }

    public function getPermalink() {
        return Yii::app()->createUrl('site/articels/view', array(
                    'year' => date('Y', $this->update_time),
                    'month' => date('d', $this->update_time),
                    'slug' => strtolower($this->slug),
        ));
    }

    public function normalizeTags() {
        $this->tags = Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }

    protected function beforeSave() {
        $split = new IMachTagHtml();
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->create_time = $this->update_time = time();
                $this->account_id = Yii::app()->user->id;
                $this->comment_status = 'E';
                $this->post_status = 'info';
                $this->pages_slug = implode(',', $this->getPage());
                $this->files_uid = implode(",", $split->getImgFileUidMachAll($this->content));               
                $this->icon == null ? $this->icon = $split->getImgMach($this->content, Yii::app()->params['img']['default_img']) : $this->icon;                
                return true;
            }
            else                
                $this->icon == null ? $this->icon = $split->getImgMach($this->content, Yii::app()->params['img']['default_img']) : $this->icon;                
                $this->pages_slug = implode(',', $this->getPage());
                $this->files_uid = implode(",", $split->getImgFileUidMachAll($this->content));
                return true;
            
        }
        else
            return false;
    }

    protected function afterSave() {
        parent::afterSave();
        Tag::model()->updateFrequency($this->_oldTags, $this->tags);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->condition = 'post_status="info"';
        $criteria->order = 'create_time DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('pages_slug', $this->pages_slug, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('post_view', $this->post_view);
        $criteria->compare('icon', $this->icon, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('update_time', $this->update_time);
        $criteria->compare('like', $this->like);
        $criteria->compare('unlike', $this->unlike);
        $criteria->compare('comment_status', $this->comment_status, true);
        $criteria->compare('post_status', $this->post_status, true);
        $criteria->compare('files_uid', $this->files_uid, true);
        $criteria->compare('cron_checked', $this->cron_checked, true);
        $criteria->compare('account_id', $this->account_id);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 4,
            ),
        ));
    }

    public function findRecentArticels($limit) {
        return $this->with('post')->findAll(array(
                    'condition' => "t.status='P'",
                    'order' => 't.create_time DESC',
                    'limit' => $limit,
        ));
    }

    public function addComment($comment) {
        if (Yii::app()->params['commentNeedApproval'])
            $comment->status = "D";
        else
            $comment->status = "P";
        $comment->post_id = $this->id;
        return $comment->save();
    }

}