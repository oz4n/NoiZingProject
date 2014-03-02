<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $address
 * @property string $about
 * @property string $birthday
 * @property string $image
 * @property integer $account_id
 *
 * The followings are the available model relations:
 * @property Account $account
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id', 'required'),
			array('account_id', 'numerical', 'integerOnly' => true),
			array('first_name, last_name', 'length', 'max' => 45),
			array('gender', 'length', 'max' => 1),
			array('address, about', 'length', 'max' => 255),
			array('birthday, image', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, gender, address, about, birthday, image, account_id', 'safe', 'on' => 'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'gender' => 'Gender',
			'address' => 'Address',
			'about' => 'About',
			'birthday' => 'Birthday',
			'image' => 'Image',
			'account_id' => 'Account',
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
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('gender', $this->gender, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('about', $this->about, true);
		$criteria->compare('birthday', $this->birthday, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('account_id', $this->account_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}