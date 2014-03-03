<?php

/**
 * This is the model class for table "nav_menu".
 *
 * The followings are the available columns in table 'nav_menu':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $position
 * @property integer $parent
 * @property string $term_id
 * @property integer $term_taxonomy_id
 *
 * The followings are the available model relations:
 * @property TermTaxonomy $termTaxonomy
 */
class NavMenu extends CActiveRecord
{
    public static $_items = array();
    public static $_list = array(0 => 'none');
    public static $_list_positions = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NavMenu the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'nav_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, parent', 'required'),
            array('parent, term_taxonomy_id', 'numerical', 'integerOnly' => true),
            array('name, position, term_id', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, slug, position, parent, term_id, term_taxonomy_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'termTaxonomy' => array(self::BELONGS_TO, 'TermTaxonomy', 'term_taxonomy_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'position' => 'Position',
            'parent' => 'Parent',
            'term_id' => 'Term',
            'term_taxonomy_id' => 'Term Taxonomy',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = "position";
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('term_id', $this->term_id, true);
        $criteria->compare('term_taxonomy_id', $this->term_taxonomy_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 7,
            ),
        ));
    }

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                return true;
            } else {
                return true;
            }
        } else
            return false;
    }

    public function findPositionByParentID($parent_id, $position)
    {
        $model = self::model()->find('parent=' . $parent_id . ' && ' . 'position=' . $position);
        return $model;
    }

    public function __getMenuAttr()
    {
        $action = CHtml::link('Edit', array('menu/update', 'id' => $this->id)) . ' | <span id="' . $this->id . '" name="' . $this->name . '" slug="' . $this->slug . '" parent="' . $this->parent . '" class="cat-confirm cat-quick-edit">Quick Edit</span>' . " | <span  class='cat-confirm delete-box' id='$this->id'>Delete</span>";
        return "<span class='c-name'>" . $this->name . "</span>" . "<br>" . $action;
    }

    public function findMenuNameByid($id)
    {
        return self::model()->findByPk($id)->name;
    }

    public function findMenuNameByTermID($id)
    {
        return Term::model()->findByPk(TermTaxonomy::model()->findByPk($id)->term_id)->name;
    }


    public function dataMenuStore()
    {
        $data = array(
            'id' => 'menu-grid',
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
                    'value' => '$data->__getMenuAttr()'
                ),
                'position',
                array(
                    'name' => 'parent',
                    'header' => 'Parent',
                    'value' => '$data->parent == 0 ? "-" : $data->findMenuNameByid($data->parent)'
                )
            ),
        );
        return $data;
    }

    public static function loadMenus()
    {
        $type = 'name';
        if (!isset(self::$_items[$type]))
            self::loadMenusItems($type);
        return CMap::mergeArray(self::$_list, self::$_items[$type]);
    }

    private static function loadMenusItems($type)
    {
        self::$_items[$type] = array();
        $models = self::model()->findAll();
        foreach ($models as $model)
            self::$_items[$type][$model->id] = ucwords($model->name);
    }

    public static function loadCreatePositions($parent_id)
    {
        $type = 'position';
        if (!isset(self::$_items[$type]))
            self::loadCreatePositionItems($type, $parent_id);
        return self::$_items[$type];
    }

    private static function loadCreatePositionItems($type, $parent_id)
    {
        $models = self::model()->findAll('parent=' . $parent_id);
        self::$_items[$type] = array((count($models) + 1) => (count($models) + 1));
        foreach ($models as $model)
            self::$_items[$type][$model->position] = ucwords($model->position);
    }

    public static function loadUpdatePositions($parent_id)
    {
        $type = 'position';
        if (!isset(self::$_items[$type]))
            self::loadUpdatePositionItems($type, $parent_id);
        return self::$_items[$type];
    }

    private static function loadUpdatePositionItems($type, $parent_id)
    {
        $models = self::model()->findAll(array('condition' => 'parent=' . $parent_id, 'order' => 'position'));
        foreach ($models as $model)
            self::$_items[$type][$model->position] = ucwords($model->position);
    }

    public function dataTreeStore($term_id)
    {
        return $this->generateTree(
            self::model()->findAll(
                array(
                    'condition' => "term_taxonomy_id=$term_id",
                    'order' => 'position'
                )
            )
        );
    }

    private function generateTree($array, $parent = 0, $level = 0)
    {
        $has_children = false;
        foreach ($array as $value) {
            if ($value['parent'] == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                    echo '<ol class="dd-list">';
                    $level++;
                }
                echo '<li class="dd-item" data-id="' . $value['id'] . '" data-position="' . $value['position'] . '" data-parent="' . $value['parent'] . '">';
                echo '<div class="dd-handle">' . $value['name'] . '</div>';
                $this->generateTree($array, $value['id'], $level);
                echo '</li>';
            }
        }
        if ($has_children === true)
            echo '</ol>';
    }

}