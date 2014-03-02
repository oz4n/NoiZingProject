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
 * @property integer $post_id
 *
 * The followings are the available model relations:
 * @property Post $post
 */
class Comment extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('author, email, content, status, post_id', 'required'),
            array('create_time, parent_replay, post_id', 'numerical', 'integerOnly' => true),
            array('author, email, url', 'length', 'max' => 128),
            array('status', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, author, email, url, content, status, create_time, parent_replay, post_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'author' => 'Author',
            'email' => 'Email',
            'url' => 'Url',
            'content' => 'Content',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'parent_replay' => 'Parent Replay',
            'post_id' => 'Post',
        );
    }
    
   
    public function getPostNameByid($id) {
        $model = Post::model()->find("id=" . $id);
        $url = Yii::app()->createUrl('site/articels/view', array('id' => $id, 'title' => $model['title']));
        return '<div class="popover-post top" >' .
                '<div class="ze ie"></div>' .
                CHtml::link(CHtml::encode($model['title']), $url) .
                "<p>With () View</p></div>";
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->condition = "parent_replay=0";


        $criteria->compare('id', $this->id);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('parent_replay', $this->parent_replay);
        $criteria->compare('post_id', $this->post_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    protected function formComment($parent_id, $post_id) {
        $model = self::model();
        $form = $this->beginWidget('CActiveForm', array('id' => 'comment-form', 'enableAjaxValidation' => false,));
        $form->textArea($model, 'content');
        $form->hiddenField($model, 'parent_replay', array('value' => $parent_id));
        $form->hiddenField($model, 'post_id', array('value' => $post_id));
        $this->endWidget();
    }

    public function getComents($status, $id, $post_id, $date, $content, $url, $email, $author) {

        if ($status == "D") {
            echo "<div id='comment-$id' style='margin-top: -16px;'></div>";
            echo "<div class='media'>";
            echo "<a class='pull-left' href='$url' >";
            echo Yii::app()->gravatar->getGravatar($email);
            echo "</a>";
            echo "<div class='media-body comment-popover span7' style='background:#FFF;'>";
            echo '<div class="ze ie"></div>';
            echo "<h3>" . CHtml::link("<b>" . $author . "</b>", $url) . " | " . str_replace("+0000", "", date("r A", $date)) . "</h3>";
            echo "<hr>";
            echo "<p style='margin-top:-20px;'>" . $content . "</p>";
            echo '<b><span class="pending">Pending approval</span> | ' . CHtml::ajaxLink('Approve', array('comment/approve', 'id' => $id), array(
                'type' => 'POST',
                'dataType' => 'json',
                'success' => 'function(data, e){ $.msgGrowl({ type: "success", title: "Approve", text: "Berhasil" }); $.fn.yiiGridView.update("comment-grid"); }',
                    ), array("id" => "cm-approve-" . $id)) . " | " . CHtml::link("Edit", array("comment/update/id/" . $id)) . " | " . CHtml::link("Delete", "#", array('id' => 'delete-com-' . $id)) . " | " . CHtml::link("Reply", "#comment-" . $id, array('id' => 'reply-' . $id)) . "<b>";
            echo "</div>";
            echo "</div>";

            echo "<div class='media' style='margin-top:0;'>";
            echo "<div class='media-body span7 comment-replay'>";
            echo '<div style="margin-top:15px;"></div>';
            $model = self::model()->findAll('parent_replay=' . $id);
            foreach ($model as $v) {
                if ($v->status == 'D') {
                    echo '<div class="media" style="margin-top: -5px; ">';
                    echo '<a class="pull-left" href="' . $v->url . '">';
                    echo Yii::app()->gravatar->getGravatar($v->email, 20);
                    echo '</a>';
                    echo '<b>' . CHtml::link($v->author, "mailto:" . $v->email);
                    echo ' | ' . str_replace("+0000", "", date("r A", $v->create_time)) . '</b>';
                    echo '<div class="media-body" style=" font-weight: normal">';
                    echo '<p style="margin-bottom:none;">' . $v->content . '</p>';
                    echo '<p style="margin-top:-20px;">' . '<span class="pending">Pending approval</span> | ' . CHtml::ajaxLink('Approve', array('comment/approve', 'id' => $v->id), array(
                        'type' => 'POST',
                        'dataType' => 'json',
                        'success' => 'function(data, e){ $.msgGrowl({ type: "success", title: "Approve", text: "Berhasil" }); $.fn.yiiGridView.update("comment-grid"); }',
                            ), array("id" => "cm-approve-" . $v->id)) . ' | ' . CHtml::link("Edit", array("comment/update/id/" . $v->id)) . " | " . CHtml::link("Delete", "#", array('id' => 'delete-com-' . $v->id)) . '</p>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="media" style="margin-top: -5px; ">';
                    echo '<a class="pull-left" href="' . $v->url . '">';
                    echo Yii::app()->gravatar->getGravatar($v->email, 20);
                    echo '</a>';
                    echo '<b>' . CHtml::link($v->author, "mailto:" . $v->email);
                    echo ' | ' . str_replace("+0000", "", date("r A", $v->create_time)) . '</b>';
                    echo '<div class="media-body" style=" font-weight: normal">';
                    echo '<p style="margin-bottom:none;">' . $v->content . '</p>';
                    echo '<p style="margin-top:-20px;">' . CHtml::link("Edit", array("comment/update/id/" . $v->id)) . " | " . CHtml::link("Delete", "#", array('id' => 'delete-com-' . $v->id)) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }

            echo "<div id='append-rep-$id'></div>";

            echo "<div class='media' id='fomr-rp-$id' style='display:none;'>";
            echo '<a class="pull-left" href="' . $url . '">';
            echo Yii::app()->gravatar->getGravatar(Account::model()->findAccount()->email, 20);
            echo '</a>';

            echo '<div class="media-body">';
            echo "<form>";
            echo CHtml::textArea('Comment[content]');
            echo CHtml::hiddenField('Comment[parent_replay]', $id);
            echo CHtml::hiddenField('Comment[post_id]', $post_id);
            echo CHtml::ajaxSubmitButton("Replay", array('comment/replay'), array(
                'type' => 'POST',
                'dataType' => 'json',
                'success' => 'function(data, e){ $("#append-rep-' . $id . '").append(data.html).fadeIn("slow"); console.log(data.html); $.msgGrowl({ type: "success", title: "Replay", text: "Berhasil" });}',
                    ), array('class' => 'btn btn-small btn-primary', 'id' => 'btn-' . $id));
            echo "</form>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div id='comment-$id'></div>";
            echo "<div  style='margin-top: -16px;'></div>";
            echo "<div class='media'>";
            echo "<a class='pull-left' href='$url' >";
            echo Yii::app()->gravatar->getGravatar($email);
            echo "</a>";
           
            echo "<div class='media-body comment-popover span7' style='background:#FFF;'>";
            echo '<div class="ze ie"></div>';
            echo "<h3>" . CHtml::link("<b>" . $author . "</b>", $url) . " | " . str_replace("+0000", "", date("r A", $date)) . "</h3>";
            echo "<hr>";
            echo "<p style='margin-top:-20px;'>" . $content . "</p>";
            echo CHtml::link("<span class='label label-inverse'><i class='icon-edit'></i>Edit </span>", array("comment/update/id/" . $id)) . "  " . CHtml::link("<span class='label label-important'><i class='icon-remove'></i>Delete</span>", "", array('id' => 'delete-com-' . $id,'style'=>'cursor: pointer;'));
            
            echo "</div>";
            echo "</div>";
            
            echo "<div class='media' style='margin-top:0;'>";
            echo "<div class='media-body span7 comment-replay'>";
            echo '<div style="margin-top:15px;"></div>';           
            $model = self::model()->findAll('parent_replay=' . $id);
            foreach ($model as $v) {
                if ($v->status == 'D') {
                    echo '<div class="media" style="margin-top: -5px; ">';
                    echo '<a class="pull-left" href="' . $v->url . '">';
//                    echo Yii::app()->gravatar->getGravatar($v->email, 20);
                    echo '</a>';
                    echo '<b>' . CHtml::link($v->author, "mailto:" . $v->email);
                    echo ' | ' . str_replace("+0000", "", date("r A", $v->create_time)) . '</b>';
                    echo '<div class="media-body" style=" font-weight: normal">';
                    echo '<p style="margin-bottom:none;">' . $v->content . '</p>';
                    echo '<p style="margin-top:-20px;">' . '<span class="pending">Pending approval</span> | ' . CHtml::ajaxLink('Approve', array('comment/approve', 'id' => $v->id), array(
                        'type' => 'POST',
                        'dataType' => 'json',
                        'success' => 'function(data, e){ $.msgGrowl({ type: "success", title: "Approve", text: "Berhasil" }); $.fn.yiiGridView.update("comment-grid"); }',
                            ), array("id" => "cm-approve-" . $v->id)) . ' | ' . CHtml::link("Edit", array("comment/update/id/" . $v->id)) . " | " . CHtml::link("Delete", "#", array('id' => 'delete-com-' . $v->id)) . '</p>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="media" style="margin-top: -5px; ">';
                    echo '<a class="pull-left" href="' . $v->url . '">';
                    echo Yii::app()->gravatar->getGravatar($v->email, 20);
                    echo '</a>';
                    echo '<b>' . CHtml::link($v->author, "mailto:" . $v->email);
                    echo ' | ' . str_replace("+0000", "", date("r A", $v->create_time)) . '</b>';
                    echo '<div class="media-body" style=" font-weight: normal">';
                    echo '<p style="margin-bottom:none;">' . $v->content . '</p>';
                    echo '<p style="margin-top:-20px;">' . CHtml::link("Edit", array("comment/update/id/" . $v->id)) . " | " . CHtml::link("Delete", "", array('id' => 'delete-com-' . $v->id,'style'=>'cursor: pointer;')) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }

            echo "<div id='append-rep-$id'></div>";
            echo CHtml::link("<span class='label'><i class='icon-share-alt'></i>Reply</span>", "", array('class'=>'pull-right','id' => 'reply-' . $id,'style'=>'margin-top:-20px; cursor: pointer;'));
            echo "<div class='media' id='fomr-rp-$id' style='display:none;'>";
            echo '<a class="pull-left" href="' . $url . '">';
            echo Yii::app()->gravatar->getGravatar(Account::model()->findAccount()->email, 20);
            echo '</a>';

            echo '<div class="media-body">';
            echo "<form>";
            echo CHtml::textArea('Comment[content]');
            echo CHtml::hiddenField('Comment[parent_replay]', $id);
            echo CHtml::hiddenField('Comment[post_id]', $post_id);
            echo CHtml::ajaxSubmitButton("Replay", array('comment/replay'), array(
                'type' => 'POST',
                'dataType' => 'json',
                'success' => 'function(data, e){ $("#append-rep-' . $id . '").append(data.html).fadeIn("slow"); console.log(data.html); $.msgGrowl({ type: "success", title: "Replay", text: "Berhasil" });}',
                    ), array('class' => 'btn btn-small btn-primary', 'id' => 'btn-' . $id));
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

    /**
     * Approves a comment.
     */
    public function approve() {
        $this->status = "P";
        $this->update(array('status'));
    }

    /**
     * @param Post the post that this comment belongs to. If null, the method
     * will query for the post.
     * @return string the permalink URL for this comment
     */
    public function getUrl($post = null) {
        if ($post === null)
            $post = $this->post;
        return $post->url . '#c' . $this->id;
    }

    /**
     * @return string the hyperlink display for the current comment's author
     */
    public function getAuthorLink() {
        if (!empty($this->url))
            return CHtml::link(CHtml::encode($this->author), $this->url);
        else
            return CHtml::encode($this->author);
    }

    /**
     * @return integer the number of comments that are pending approval
     */
    public function getPendingCommentCount() {
        return $this->count("status='D'");
    }
    
  

    public function findRecentComments($limit = 10) {
        return $this->with('post')->findAll(array(
                    'condition' => "t.status='P'",
                    'order' => 't.create_time DESC',
                    'limit' => $limit,
                ));
    }

    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            $model = self::model()->findAll('parent_replay=' . $this->id);
            foreach ($model as $v) {
                self::model()->findByPk($v->id)->delete();
            }
            return true;
        } else
            return false;
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord)
                $this->create_time = time();
            return true;
        }
        else
            return false;
    }

}