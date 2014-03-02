<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $level
 *
 * The followings are the available model relations:
 * @property Ftpaccount[] $ftpaccounts
 * @property Post[] $posts
 * @property Profile[] $profiles
 */
class Account extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Account the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, salt, email, level', 'required'),
            array('username, password, salt, email', 'length', 'max' => 128),
            array('level', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, salt, email, level', 'safe', 'on' => 'search'),
        );
    }
   
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ftpaccounts' => array(self::HAS_MANY, 'Ftpaccount', 'account_id'),
            'posts' => array(self::HAS_MANY, 'Post', 'account_id'),
            'profile' => array(self::HAS_ONE, 'Profile', 'account_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'salt' => 'Salt',
            'email' => 'Email',
            'level' => 'Level',
        );
    }

    public function beforeDelete() {
        Ftpaccount::model()->deleteAll('account_id=' . $this->id);
        Profile::model()->deleteAll('account_id=' . $this->id);
        return parent::beforeDelete();
    }
    
     protected function afterSave() {
        if ($this->isNewRecord) {
            $profile = new Profile;
            $profile->account_id = $this->id;
            $profile->save();
            return parent::afterSave();
        } else {
            return false;
        }
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('level', $this->level, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function validatePassword($password) {
        return $password === $this->password;
    }

    public function findAccount() {
        return self::model()->find('id=' . Yii::app()->user->id);
    }

}

