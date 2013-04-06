<?php

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $gender
 * @property string $birthday
 * @property string $address
 * @property string $province
 * @property string $zipcode
 * @property string $tel
 * @property string $mobile
 * @property string $avatar
 * @property string $note
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, gender, birthday, address, province, zipcode, mobile, user_id', 'required'),
			array('firstname, lastname, province, avatar', 'length', 'max'=>45),
			array('gender', 'length', 'max'=>1),
			array('zipcode', 'length', 'max'=>5),
			array('tel, mobile', 'length', 'max'=>15),
			array('user_id', 'length', 'max'=>10),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, lastname, gender, birthday, address, province, zipcode, tel, mobile, avatar, note, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'gender' => 'Gender',
			'birthday' => 'Birthday',
			'address' => 'Address',
			'province' => 'Province',
			'zipcode' => 'Zipcode',
			'tel' => 'Tel',
			'mobile' => 'Mobile',
			'avatar' => 'Avatar',
			'note' => 'Note',
			'user_id' => 'User',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}