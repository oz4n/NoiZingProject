<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property string $address
 * @property string $fax
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property string $status
 * @property integer $position
 * @property string $other
 */
class Contact extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Contact the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'contact';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, status', 'required'),
            array('position', 'numerical', 'integerOnly' => true),
            array('name, email, website', 'length', 'max' => 45),
            array('location, address, fax, phone', 'length', 'max' => 255),
            array('status', 'length', 'max' => 7),
            array('other', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, location, address, fax, phone, email, website, status, position, other', 'safe', 'on' => 'search'),
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
            'name' => 'Name',
            'location' => 'Location',
            'address' => 'Address',
            'fax' => 'Fax',
            'phone' => 'Phone',
            'email' => 'Email',
            'website' => 'Website',
            'status' => 'Status',
            'position' => 'Position',
            'other' => 'Other',
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
        $criteria->order = "position";
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('position', $this->position);
        $criteria->compare('other', $this->other, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}