<?php

/**
 * This is the model class for table "component".
 *
 * The followings are the available columns in table 'component':
 * @property integer $id
 * @property string $name
 * @property string $file_name
 * @property string $status
 * @property string $description
 * @property string $other
 */
class Component extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'component';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, file_name, status', 'required'),
            array('name', 'length', 'max' => 45),
            array('file_name, description', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('other', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, file_name, status, description, other', 'safe', 'on' => 'search'),
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
            'file_name' => 'Plugin',
            'status' => 'Status',
            'description' => 'Description',
            'other' => 'Other',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('file_name', $this->file_name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('other', $this->other, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 12,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Component the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}