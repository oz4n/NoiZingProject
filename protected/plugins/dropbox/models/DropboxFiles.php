<?php

/**
 * This is the model class for table "dropbox_files".
 *
 * The followings are the available columns in table 'dropbox_files':
 * @property integer $id
 * @property string $files_uid
 * @property string $name
 * @property string $status
 * @property string $path
 * @property string $type
 * @property string $mime_type
 * @property string $url_share
 * @property string $url_thumbnail_share
 * @property integer $dropbox_account_id
 * 
 * The followings are the available model relations:
 * @property DropboxAccount[] $dropboxaccount
 */
class DropboxFiles extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DropboxFiles the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dropbox_files';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('files_uid, name, path, url_share, dropbox_account_id', 'required'),
            array('dropbox_account_id', 'numerical', 'integerOnly' => true),
            array('files_uid', 'length', 'max' => 45),
            array('status', 'length', 'max' => 1),
            array('type', 'length', 'max' => 8),
            array('mime_type', 'length', 'max' => 255),
            array('url_thumbnail_share', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, files_uid, name, status, path, type, mime_type, url_share, url_thumbnail_share, dropbox_account_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'dropboxaccount' => array(self::BELONGS_TO, 'DropboxAccount', 'dropbox_account_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'files_uid' => 'Files Uid',
            'name' => 'Name',
            'status' => 'Status',
            'path' => 'Path',
            'type' => 'Type',
            'mime_type' => 'Mime Type',
            'url_share' => 'Url Share',
            'url_thumbnail_share' => 'Url Thumbnail Share',
            'dropbox_account_id' => 'Dropbox Account',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';  
        $criteria->condition = 'type="img"';
        $criteria->compare('id', $this->id);
        $criteria->compare('files_uid', $this->files_uid, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('mime_type', $this->mime_type, true);
        $criteria->compare('url_share', $this->url_share, true);
        $criteria->compare('url_thumbnail_share', $this->url_thumbnail_share, true);
        $criteria->compare('dropbox_account_id', $this->dropbox_account_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
             'pagination' => array(
                'pageSize' => 35,
            ),
        ));
    }

}