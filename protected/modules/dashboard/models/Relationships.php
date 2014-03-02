<?php

/**
 * This is the model class for table "relationships".
 *
 * The followings are the available columns in table 'relationships':
 * @property integer $post_id
 * @property integer $term_taxonomy_id
 */
class Relationships extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Relationships the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'relationships';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('post_id, term_taxonomy_id', 'required'),
            array('post_id, term_taxonomy_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('post_id, term_taxonomy_id', 'safe', 'on' => 'search'),
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
            'post_id' => 'Post',
            'term_taxonomy_id' => 'Term Taxonomy',
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

        $criteria->compare('post_id', $this->post_id);
        $criteria->compare('term_taxonomy_id', $this->term_taxonomy_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getIds($return, $attribute, $id) {
        $ids = array();
        $models = self::model()->findAllByAttributes(array($attribute => $id));
        foreach ($models as $model) {
            $ids[] = $model->$return;
        }
        return $ids;
    }

}