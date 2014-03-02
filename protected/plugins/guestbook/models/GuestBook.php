<?php

/**
 * This is the model class for table "guest_book".
 *
 * The followings are the available columns in table 'guest_book':
 * @property integer $id
 * @property string $subject
 * @property string $name
 * @property string $email
 * @property string $web_url
 * @property string $content
 * @property integer $create_time
 * @property integer $parent_id
 * @property string $verifyCode
 */
class GuestBook extends CActiveRecord {
    public $verifyCode;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GuestBook the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'guest_book';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subject, name, email, content, verifyCode', 'required'),
            array('create_time', 'numerical', 'integerOnly' => true),
            array('name, email, web_url', 'length', 'max' => 45),  
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, email, web_url, content, create_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'subject' => 'Subject',
            'name' => 'Name',
            'email' => 'Email',
            'web_url' => 'Website',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'parent_id' => 'parent_id',
            'verifyCode' => 'Verify Code'
        );
    }
    
//    public function beforeSave() {
//        parent::beforeSave();
//    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'create_time DESC';
        $criteria->condition = 'parent_id =0 && status="P"';
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('web_url', $this->web_url, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('parent_id', $this->parent_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
             'pagination' => array(
                'pageSize' => 10,
            ),
        ));
    }

}