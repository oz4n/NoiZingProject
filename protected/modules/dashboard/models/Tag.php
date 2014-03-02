<?php

/**
 * This is the model class for table "tag".
 *
 * The followings are the available columns in table 'tag':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $frequency
 */
class Tag extends CActiveRecord {

    private $_table = 'tag';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Tag the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return $this->_table;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('frequency', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('description', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, description, frequency', 'safe', 'on' => 'search'),
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
            'description' => 'Description',
            'frequency' => 'Frequency',
        );
    }

    /**
     * Returns tag names and their corresponding weights.
     * Only the tags with the top weights will be returned.
     * @param integer the maximum number of tags that should be returned
     * @return array weights indexed by tag names.
     */
    public function findTagWeights($limit = 20) {
        $models = $this->findAll(array(
            'order' => 'frequency DESC',
            'limit' => $limit,
        ));

        $total = 0;
        foreach ($models as $model)
            $total+=$model->frequency;

        $tags = array();
        if ($total > 0) {
            foreach ($models as $model)
                $tags[$model->name] = 8 + (int) (16 * $model->frequency / ($total + 10));
            ksort($tags);
        }
        return $tags;
    }

    /**
     * Suggests a list of existing tags matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of tags to be returned
     * @return array list of matching tag names
     */
    public function suggestTags($keyword, $limit = 20) {
        $tags = $this->findAll(array(
            'condition' => 'name LIKE :keyword',
            'order' => 'frequency DESC, Name',
            'limit' => $limit,
            'params' => array(
                ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
            ),
        ));
        $names = array();
        foreach ($tags as $tag)
            $names[] = $tag->name;
        return $names;
    }

    public static function string2array($tags) {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags) {
        return implode(', ', $tags);
    }

    public function updateFrequency($oldTags, $newTags) {
        $oldTags = self::string2array($oldTags);
        $newTags = self::string2array($newTags);
        $this->addTags(array_values(array_diff($newTags, $oldTags)));
        $this->removeTags(array_values(array_diff($oldTags, $newTags)));
    }

    public function addTags($tags) {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('name', $tags);
        $this->updateCounters(array('frequency' => 1), $criteria);
        foreach ($tags as $name) {
            if (!$this->exists('name=:name', array(':name' => $name))) {
                $tag = new Tag;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            }
        }
    }

    public function removeTags($tags) {
        if (empty($tags))
            return;
        $criteria = new CDbCriteria;
        $criteria->addInCondition('name', $tags);
        $this->updateCounters(array('frequency' => -1), $criteria);
        $this->deleteAll('frequency<=0');
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('first_name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('frequency', $this->frequency, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 6,
            ),
        ));
    }
    
    public function __getTagAttr() {
        $action = CHtml::link('Edit', array('tag/update', 'id' => $this->id)) . ' | <span id="' . $this->id . '" name="' . $this->name . '" class="tag-confirm tag-quick-edit">Quick Edit</span>' . " | <span  class='tag-confirm delete-box id-" . $this->id . "'>Delete</span>";
        return "<span class='c-name'>" . $this->name . "</span>" . "<br>" . $action;
    }

    public function dataStore() {
        $data = array(
            'id' => 'tag-grid',
            'type' => 'bordered',
            'dataProvider' => $this->search(),
            'template' => "{items}{pager}",
            'ajaxUpdate' => true,
            'selectableRows' => 2,
            'htmlOptions' => array('class' => 'table-highlight '),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => 'Name',
                    'type' => 'raw',
                    'value' => '$data->__getTagAttr()'
                ),               
                array(
                    'name' => 'description',
                    'type' => 'raw',
                    'value' => '$data->description'
                ),
                 array(
                    'name' => 'frequency',
                    'type' => 'raw',
                    'header' => 'Frequency Used',
                    'value' => '$data->frequency'
                ),
            ),
        );
        return $data;
    }

}