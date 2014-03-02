<?php

/**
 * This is the model class for table "term_taxonomy".
 *
 * The followings are the available columns in table 'term_taxonomy':
 * @property integer $id
 * @property string $type
 * @property string $description
 * @property string $count
 * @property string $status
 * @property integer $parent
 * @property integer $term_id
 *
 * The followings are the available model relations:
 * @property NavMenu[] $navMenus
 * @property Post[] $posts
 * @property Term $term
 */
class TermTaxonomy extends CActiveRecord {

    public static $_items = array();
    public static $_list = array(0 => 'None');
    private $_table = 'term_taxonomy';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TermTaxonomy the static model class
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
//            array('type, term_id', 'required'),
            array('parent, term_id', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 13),
            array('description', 'length', 'max' => 255),
            array('count', 'length', 'max' => 45),
            array('status', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, type, description, count, status, parent, term_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

        return array(
            'parent' => array(self::BELONGS_TO, 'Category', 'parent', 'condition' => 't.parent <> 0'),
            'category' => array(self::HAS_MANY, 'Category', 'parent'),
            'posts' => array(self::MANY_MANY, 'Post', 'relationships(term_taxonomy_id, post_id)'),
            'postsCount' => array(self::STAT, 'Post', 'relationships(term_taxonomy_id, post_id)'),
            'navMenus' => array(self::HAS_MANY, 'NavMenu', 'term_taxonomy_id'),
            'term' => array(self::BELONGS_TO, 'Term', 'term_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'description' => 'Description',
            'count' => 'Count',
            'status' => 'Status',
            'parent' => 'Parent',
            'term_id' => 'Term',
            
            'term[name]' => 'Name',
            'term[slug]' => 'Slug',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchCategory() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->condition = "type='category'";
        $criteria->with = 'postsCount';

        $criteria->compare('id', $this->id);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('count', $this->count, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('term_id', $this->term_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 7,
            ),
        ));
    }
    
    

    public function beforeDelete() {        
//        $model = self::model()->findAll('parent='.$this->id);
//       
//            $model->parent = 0;
//            $model->save();
      
        Relationships::model()->deleteAll('term_taxonomy_id=' . $this->id);
        return parent::beforeDelete();
    }


    public function categoryDataStore() {
        $data = array(
            'id' => 'navigasi-grid',
            'type' => 'bordered',
            'dataProvider' => $this->searchCategory(),
            'template' => "{items}{pager}",
            'ajaxUpdate' => false,
            'selectableRows' => 2,
            'htmlOptions' => array('class' => 'table-highlight '),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => 'Name',
                    'type' => 'html',
                    'value' => '$data->__getAttr()'
                ),
                array(
                    'name' => 'parent',
                    'header' => 'Parent',
                    'value' => 'ucwords($data->__getParentName())'
                ),
                array(
                    'name' => 'slug',
                    'type' => 'html',
                    'value' => '$data->term->slug'
                ),
            ),
        );
        return $data;
    }


//    public function getCategoryNameByPostID($id) {
//        $model = self::model()->with(
//                        array(
//                            'posts' => array(
//                                'condition' => 'post_id=' . $id
//                            )
//                        )
//                )->findAll('type="category"');
//        $data = array();
//        foreach ($model as $value) {
//            $data[] = $value->name;
//        }
//        return $data;
//    }

    public static function loadCategorys($status) {
        $type = 'name';
        if (!isset(self::$_items[$type]))
            self::loadCategorysItems($type,$status);
        return CMap::mergeArray(self::$_list, self::$_items[$type]);
    }

    private static function loadCategorysItems($type,$status) {
        self::$_items[$type] = array();
        $models = self::model()->findAll("type='".$status."'");
        foreach ($models as $model)
            self::$_items[$type][$model->id] = ucwords($model->term->name);
    }
    
    public static function loadPageCategorys() {
        $type = 'name';       
        if (!isset(self::$_items[$type]))
            self::loadPageCategorysItems($type);
        return CMap::mergeArray(self::$_list, self::$_items[$type]);
    }

    private static function loadPageCategorysItems($type) {
        self::$_items[$type] = array();
        $models = self::model()->findAll("type='pages'");
        foreach ($models as $model)
            self::$_items[$type][$model->id] = ucwords($model->term->name);
    }

}