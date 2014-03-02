<?php

/**
 * This is the model class for table "term".
 *
 * The followings are the available columns in table 'term':
 * @property integer $id
 * @property string $name
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property TermTaxonomy[] $termTaxonomies
 */
class Term extends CActiveRecord {

    private $_table = 'term';
    public $parent;
    public $status;
    public $description;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Term the static model class
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

    public function behaviors() {
        return array(
            'ESaveRelatedBehavior' => array('class' => 'dashboard.components.behaviors.ESaveRelatedBehavior'),
            'sluggable' => array(
                'class' => 'ext.behaviors.SluggableBehavior',
                'columns' => array('name'),
                'unique' => true,
                'update' => true,
            ),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name', 'length', 'max' => 45),
            array('name, parent, status', 'required'),
            array('description', 'length', 'max' => 255),
            array('id, name, slug, parent, status, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'termTaxonomies' => array(self::HAS_MANY, 'TermTaxonomy', 'term_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'parent' => 'Parent',
            'status' => 'Status',
            'description' => 'Description',
        );
    }

    public function beforeDelete() {
        parent::beforeDelete();
        $model = TermTaxonomy::model()->findAll('parent=' . $this->termTaxonomies[0]->id);
        foreach ($model as $v) {
            $trx = TermTaxonomy::model()->findByPk($v->id);
            $trx->parent = 0;
            $trx->save();
        }
        return true;
    }

    public function afterDelete() {
        parent::afterDelete();
        $model = NavMenu::model()->find("term_id=" . $this->id);

        if ($model == true) {
            foreach (NavMenu::model()->findAll("parent=$model->id") as $v) {
                $menu = NavMenu::model()->findByPk($v->id);
                $menu->parent = 0;
                $menu->save();
            }
            $model->delete();
        }
        return true;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function categorySearch() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);

        $criteria->with = array('termTaxonomies' => array('select' => 'termTaxonomies AS te te.type, te.parent, te.count, te.status, ts.term_id', 'together' => true));
        $criteria->condition = 'type="category"';
        $criteria->compare('parent', $this->parent, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'name' => array(
                        'asc' => 'name',
                        'desc' => 'name DESC'
                    ),
                    'slug' => array(
                        'asc' => 'slug',
                        'desc' => 'slug DESC',
                    ),
                    'parent' => array(
                        'asc' => 'parent',
                        'desc' => 'parent DESC',
                    )
                ),
            ),
        ));
    }

    public function postCategorySearch() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);

        $criteria->with = array('termTaxonomies' => array('select' => 'termTaxonomies AS te te.type, te.parent, te.count, te.status, ts.term_id', 'together' => true));
        $criteria->condition = 'type="page_category"';
        $criteria->compare('parent', $this->parent, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'name' => array(
                        'asc' => 'name',
                        'desc' => 'name DESC'
                    ),
                    'slug' => array(
                        'asc' => 'slug',
                        'desc' => 'slug DESC',
                    ),
                    'parent' => array(
                        'asc' => 'parent',
                        'desc' => 'parent DESC',
                    )
                ),
            ),
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function pageCategorySearch() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);

        $criteria->with = array('termTaxonomies' => array('select' => 'termTaxonomies AS te te.type, te.parent, te.count, te.status, ts.term_id', 'together' => true));
        $criteria->condition = 'type="pages"';
        $criteria->compare('parent', $this->parent, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'name' => array(
                        'asc' => 'name',
                        'desc' => 'name DESC'
                    ),
                    'slug' => array(
                        'asc' => 'slug',
                        'desc' => 'slug DESC',
                    ),
                    'parent' => array(
                        'asc' => 'parent',
                        'desc' => 'parent DESC',
                    )
                ),
            ),
        ));
    }

    public function __getCatAttr() {
        $status = Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) == "Draft" ? "<span style=\"color:red\">" . Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) . "</span>" : "<span style=\"color:#83b245\">" . Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) . "</span>";
        $action = CHtml::link('Edit', array('category/update', 'id' => $this->id)) . ' | <span id="' . $this->id . '" name="' . $this->name . '" slug="' . $this->slug . '" parent="' . $this->termTaxonomies[0]->parent . '" status="' . $this->termTaxonomies[0]->status . '" class="cat-confirm cat-quick-edit">Quick Edit</span>' . " | <span  class='cat-confirm delete-box id-" . $this->id . "'>Delete</span>";
        return "<span class='c-name'>" . $this->name . "</span>" . " (" . $this->termTaxonomies[0]->count . ") is " . $status . "<br>" . $action;
    }

    public function dataCategoryStore() {
        $data = array(
            'id' => 'category-grid',
            'type' => 'bordered',
            'dataProvider' => $this->categorySearch(),
            'template' => "{items}{pager}",
            'ajaxUpdate' => true,
            'selectableRows' => 2,
            'htmlOptions' => array('class' => 'table-highlight '),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => 'Name',
                    'type' => 'raw',
                    'value' => '$data->__getCatAttr()'
                ),
                array(
                    'name' => 'parent',
                    'header' => 'Parent',
                    'value' => '$data->termTaxonomies[0]->parent == 0 ? "-" : $data->findTermTaxonomyNameByid($data->termTaxonomies[0]->parent)'
                ),
                array(
                    'name' => 'slug',
                    'type' => 'html',
                    'value' => '$data->slug'
                ),
            ),
        );
        return $data;
    }

    public function __getPostCatAttr() {
        $status = Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) == "Draft" ? "<span style=\"color:red\">" . Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) . "</span>" : "<span style=\"color:#83b245\">" . Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) . "</span>";
        $action = CHtml::link('Edit', array('postcategory/update', 'id' => $this->id)) . ' | <span id="' . $this->id . '" name="' . $this->name . '" slug="' . $this->slug . '" parent="' . $this->termTaxonomies[0]->parent . '" status="' . $this->termTaxonomies[0]->status . '" class="cat-confirm cat-quick-edit">Quick Edit</span>' . " | <span  class='cat-confirm delete-box id-" . $this->id . "'>Delete</span>";
        return "<span class='c-name'>" . $this->name . "</span>" . " (" . $this->termTaxonomies[0]->count . ") is " . $status . "<br>" . $action;
    }

    public function dataPostCategoryStore() {
        $data = array(
            'id' => 'category-grid',
            'type' => 'bordered',
            'dataProvider' => $this->postCategorySearch(),
            'template' => "{items}{pager}",
            'ajaxUpdate' => true,
            'selectableRows' => 2,
            'htmlOptions' => array('class' => 'table-highlight '),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => 'Name',
                    'type' => 'raw',
                    'value' => '$data->__getPostCatAttr()'
                ),
                array(
                    'name' => 'parent',
                    'header' => 'Parent',
                    'value' => '$data->termTaxonomies[0]->parent == 0 ? "-" : $data->findTermTaxonomyNameByid($data->termTaxonomies[0]->parent)'
                ),
                array(
                    'name' => 'slug',
                    'type' => 'html',
                    'value' => '$data->slug'
                ),
            ),
        );
        return $data;
    }

    public function __getPageCatAttr() {
        $status = Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) == "Draft" ? "<span style=\"color:red\">" . Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) . "</span>" : "<span style=\"color:#83b245\">" . Lookup::item("CategoryStatus", $this->termTaxonomies[0]->status) . "</span>";
        $action = CHtml::link('Edit', array('pagecategory/update', 'id' => $this->id)) . ' | <span id="' . $this->id . '" name="' . $this->name . '" slug="' . $this->slug . '" parent="' . $this->termTaxonomies[0]->parent . '" status="' . $this->termTaxonomies[0]->status . '" class="cat-confirm cat-quick-edit">Quick Edit</span>' . " | <span  class='cat-confirm delete-box id-" . $this->id . "'>Delete</span>";
        return "<span class='c-name'>" . $this->name . "</span>" . " (" . $this->termTaxonomies[0]->count . ") is " . $status . "<br>" . $action;
    }

    public function dataPageCategoryStore() {
        $data = array(
            'id' => 'pagecategory-grid',
            'type' => 'bordered',
            'dataProvider' => $this->pageCategorySearch(),
            'template' => "{items}{pager}",
            'ajaxUpdate' => true,
            'selectableRows' => 2,
            'htmlOptions' => array('class' => 'table-highlight '),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => 'Name',
                    'type' => 'raw',
                    'value' => '$data->__getPageCatAttr()'
                ),
                array(
                    'name' => 'parent',
                    'header' => 'Parent',
                    'value' => '$data->termTaxonomies[0]->parent == 0 ? "-" : $data->findTermTaxonomyNameByid($data->termTaxonomies[0]->parent)'
                ),
                array(
                    'name' => 'slug',
                    'type' => 'html',
                    'value' => '$data->slug'
                ),
            ),
        );
        return $data;
    }

    public function findTermTaxonomyNameByid($id) {
        return TermTaxonomy::model()->findByPk($id)->term->name;
    }

}