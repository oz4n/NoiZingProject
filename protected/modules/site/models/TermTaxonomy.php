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
class TermTaxonomy extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TermTaxonomy the static model class
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
		return 'term_taxonomy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, term_id', 'required'),
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
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'navMenus' => array(self::HAS_MANY, 'NavMenu', 'term_taxonomy_id'),
			'posts' => array(self::MANY_MANY, 'Post', 'relationships(term_taxonomy_id, post_id)'),
			'term' => array(self::BELONGS_TO, 'Term', 'term_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'description' => 'Description',
			'count' => 'Count',
			'status' => 'Status',
			'parent' => 'Parent',
			'term_id' => 'Term',
		);
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('count', $this->count, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('parent', $this->parent);
		$criteria->compare('term_id', $this->term_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}