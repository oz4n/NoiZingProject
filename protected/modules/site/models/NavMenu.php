<?php

/**
 * This is the model class for table "nav_menu".
 *
 * The followings are the available columns in table 'nav_menu':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $slug
 * @property integer $position
 * @property integer $parent
 * @property string $status
 * @property string $term_id
 * @property integer $term_taxonomy_id
 *
 * The followings are the available model relations:
 * @property TermTaxonomy $termTaxonomy
 */
class NavMenu extends CActiveRecord
{
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
			array('name, type, slug, position, term_id, term_taxonomy_id', 'required'),
			array('position, parent, term_taxonomy_id', 'numerical', 'integerOnly' => true),
			array('name, term_id', 'length', 'max' => 45),
			array('type', 'length', 'max' => 9),
			array('status', 'length', 'max' => 1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, slug, position, parent, status, term_id, term_taxonomy_id', 'safe', 'on' => 'search'),
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
			'type' => 'Type',
			'slug' => 'Slug',
			'position' => 'Position',
			'parent' => 'Parent',
			'status' => 'Status',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('position', $this->position);
		$criteria->compare('parent', $this->parent);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('term_id', $this->term_id, true);
		$criteria->compare('term_taxonomy_id', $this->term_taxonomy_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}