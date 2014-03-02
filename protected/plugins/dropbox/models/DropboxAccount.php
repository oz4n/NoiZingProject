<?php

/**
 * This is the model class for table "dropbox_account".
 *
 * The followings are the available columns in table 'dropbox_account':
 * @property integer $id
 * @property string $uid
 * @property string $display_name
 * @property string $email
 * @property string $type
 * @property string $key
 * @property string $secret
 * @property string $access_token
 * @property string $referral_link
 * @property integer $quota_normal
 * @property integer $quota_in_used
 * @property integer $quota_in_shared
 * @property integer $account_id
 *  
 * The followings are the available model relations:
 * @property DropboxFiles[] $dropboxfiles
 */
class DropboxAccount extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DropboxAccount the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dropbox_account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid, display_name, email, referral_link, account_id', 'required'),
            array('quota_normal, quota_in_used, quota_in_shared, account_id', 'numerical', 'integerOnly' => true),
            array('uid, display_name, email, referral_link', 'length', 'max' => 45),
            array('type', 'length', 'max' => 1),
            array('key, secret, access_token', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, uid, display_name, email, type, key, secret, access_token, referral_link, quota_normal, quota_in_used, quota_in_shared, account_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'dropboxfiles' => array(self::HAS_MANY, 'DropboxFiles', 'dropbox_account_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'uid' => 'Uid',
            'display_name' => 'Display Name',
            'email' => 'Email',
            'type' => 'Type',
            'key' => 'Key',
            'secret' => 'Secret',
            'access_token' => 'Access Token',
            'referral_link' => 'Referral Link',
            'quota_normal' => 'Quota Normal',
            'quota_in_used' => 'Quota In Used',
            'quota_in_shared' => 'Quota In Shared',
            'account_id' => 'Account',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('display_name', $this->display_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('key', $this->key, true);
        $criteria->compare('secret', $this->secret, true);
        $criteria->compare('access_token', $this->access_token, true);
        $criteria->compare('referral_link', $this->referral_link, true);
        $criteria->compare('quota_normal', $this->quota_normal);
        $criteria->compare('quota_in_used', $this->quota_in_used);
        $criteria->compare('quota_in_shared', $this->quota_in_shared);
        $criteria->compare('account_id', $this->account_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}