<?php

/**
 * This is the model class for table "research".
 *
 * The followings are the available columns in table 'research':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $download_count
 * @property integer $view_count
 * @property string $create_date
 * @property string $user_id
 * @property string $research_group_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property ResearchGroup $researchGroup
 * @property ResearchFile[] $researchFiles
 * @property Conference[] $conferences
 */
class Research extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Research the static model class
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
		return 'research';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, user_id, research_group_id', 'required'),
			array('download_count, view_count', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('user_id, research_group_id', 'length', 'max'=>10),
			array('description, create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, download_count, view_count, create_date, user_id, research_group_id', 'safe', 'on'=>'search'),
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
			'researchGroup' => array(self::BELONGS_TO, 'ResearchGroup', 'research_group_id'),
			'researchFiles' => array(self::HAS_MANY, 'ResearchFile', 'research_id'),
			'conferences' => array(self::MANY_MANY, 'Conference', 'research_has_conference(research_id, conference_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'download_count' => 'Download Count',
			'view_count' => 'View Count',
			'create_date' => 'Create Date',
			'user_id' => 'User',
			'research_group_id' => 'Research Group',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('download_count',$this->download_count);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('research_group_id',$this->research_group_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}