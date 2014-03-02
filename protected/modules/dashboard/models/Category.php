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
class Category extends CActiveRecord {

    public static $_items = array();
    public static $_list = array(0 => 'None');
    protected $_categoryTree = array();
    protected $_categoryFlat = array();
    public $_table = 'term_taxonomy';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Navigasi the static model class
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

//    public function behaviors() {
//        return array(
//            'sluggable' => array(
//                'class' => 'ext.behaviors.SluggableBehavior',
//                'columns' => array('name'),
//                'unique' => true,
//                'update' => true,
//            ),
//        );
//    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('type, term_id', 'required'),
            array('parent, term_id', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 8),
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

    public function beforeDelete() {
        Relationships::model()->deleteAll('term_taxonomy_id=' . $this->id);
        return parent::beforeDelete();
    }

//    public function __getParentName() {
//        return $this->parent == 0 ? '-' : self::model()->findByPk($this->parent)->term->name;
//    }
//
//    public function __getAttr() {
//        $url = Yii::app()->createUrl('dashboard/category/edit', array('id' => 1));
//        $status = Lookup::item("CategoryStatus", $this->status) == "Draft" ? "<span style=\"color:red\">" . Lookup::item("CategoryStatus", $this->status) . "</span>" : "<span style=\"color:#83b245\">" . Lookup::item("CategoryStatus", $this->status) . "</span>";
//        $action = CHtml::link('Edit', array('category/update','id'=> $this->id)) . ' | ' . CHtml::link('Quick Edit', '', array("class" => "cat-quick-edit")) . " | " . CHtml::link('Delete', array('#')) . " | " . CHtml::link("View", array('#'));
//        return "<span class='c-name'>" . $this->term->name . "</span>" . " (" . $this->count . ") is " . $status . "<br>" . $action;
//    }

//    public function init() {
//        parent::init();
//        $url = Yii::app()->createUrl('dashboard/category/edit', array('id' => $this->id));
//        $form_js = '\'<td colspan="3" class="form-edit" ><div class="row-fluid"><h4>Quick Edit</h4><form class="form-cat" action="' . $url . '"> <div class="control-group"><div class="controls"><input type="text" class="span12" placeholder="Name"></div></div><div class="control-group"><div class="controls"><input type="text" class="span12" placeholder="Slug"></div></div><button type="button" class="cancel btn btn-small pull-left">Cencel</button> <button type="submit" class="btn btn-small pull-right">Update Category</button></form></div></td>\'';
//        Yii::app()->clientScript->registerScript('coba', '                    
//                    $("a.cat-quick-edit").live("click", function(){                           
//                       vattr = $(this).parent().parent().children();                                    
//                       vattr.css("display","none");
//                       $(this).parent().parent().prepend(' . $form_js . ');  
//                       ds = $(this).parent().parent();    
//                       console.log($(this).parent().parent().children())
//                    });
//                    $("button.cancel").live("click", function(){                        
//                        vattr = $("button.cancel").parent().parent().parent().parent().children();
//                        vattr.css("display","");
//                        $(".form-edit").remove();
//                        console.log(vattr)
//                    });
//                    ', CClientScript::POS_READY);
//    }

    public function dataStore() {
        $data = array(
            'id' => 'navigasi-grid',
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

    public function getCategoryTree($format) {
        $categories = self::model()->findAll(array('condition' => 'type="category"'));
        foreach ($categories as $c) {
            if ($c->parent == null)
                $c->parent = 0;
            $this->_categoryTree[$c->parent][$c->id] = $c->term->name . ' (' . $c->count . ')';
        }

        switch ($format) {
            case 'flat':
                $this->level2Label();
                return $this->_categoryFlat;
                break;
            case 'tree':
                return $this->formatTree();
                break;
        }
    }

    protected function level2Label($parent_id = 0, $level = 0) {
        foreach ($this->_categoryTree[$parent_id] as $key => $val) {
            $this->_categoryFlat[$key] = str_repeat('&nbsp;', 4 * $level) . $val;
            if (isset($this->_categoryTree[$key]) && $key > 0)
                $this->level2Label($key, $level + 1);
        }
    }

    protected function formatTree($parent_id = 0) {
        $data = array();
        foreach ($this->_categoryTree[$parent_id] as $key => $val) {
            $children = isset($this->_categoryTree[$key]) ? $this->formatTree($key) : null;
            $expand = $children ? true : false;
            $data[] = array('id' => $key, 'title' => $val, 'icon' => false, 'expand' => $expand, 'children' => $children);
        }
        return $data;
    }

    public function getCategoryNameByPostID($id, $data = array()) {
        foreach (self::model()->with(array('posts' => array('condition' => 'post_id=' . $id)))->findAll('type="category"') as $value) {
            $data[] = array("name"=>$value->term->name,"slug"=>$value->term->slug);
        }
        return $data;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
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

    public static function loadCategorys() {
        $type = 'name';
        if (!isset(self::$_items[$type]))
            self::loadCategorysItems($type);
        return CMap::mergeArray(self::$_list, self::$_items[$type]);
    }

    private static function loadCategorysItems($type) {
        self::$_items[$type] = array();
        $models = self::model()->findAll("type='category'");
        foreach ($models as $model)
            self::$_items[$type][$model->id] = ucwords($model->term->name);
//           if ($model->parent == 0)
//                self::$_items[$type][$model->id] = ucwords($model->term->name);
//           else
//                self::$_items[$type][$model->id] = '&nbsp;&nbsp;&nbsp;'.ucwords($model->term->name);
    }

}