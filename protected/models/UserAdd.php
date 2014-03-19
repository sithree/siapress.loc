<?php

/**
 * This is the model class for table "{{user_add}}".
 *
 * The followings are the available columns in table '{{user_add}}':
 * @property integer $user_id
 * @property integer $sex
 * @property string $country
 * @property string $city
 * @property string $site
 * @property string $about
 * @property string $interests
 * @property string $birdthday
 * @property string $icq
 * @property string $skype
 * @property string $odnoklassniki
 * @property string $phone
 * @property string $params
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class UserAdd extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserAdd the static model class
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
		return '{{user_add}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, sex', 'numerical', 'integerOnly'=>true),
			array('country, city, skype', 'length', 'max'=>25),
			array('site', 'length', 'max'=>100),
			array('icq', 'length', 'max'=>20),
			array('odnoklassniki, phone', 'length', 'max'=>50),
			array('params', 'length', 'max'=>255),
			array('about, interests, birdthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, sex, country, city, site, about, interests, birdthday, icq, skype, odnoklassniki, phone, params', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'sex' => 'Sex',
			'country' => 'Country',
			'city' => 'City',
			'site' => 'Site',
			'about' => 'About',
			'interests' => 'Interests',
			'birdthday' => 'Birdthday',
			'icq' => 'Icq',
			'skype' => 'Skype',
			'odnoklassniki' => 'Odnoklassniki',
			'phone' => 'Phone',
			'params' => 'Params',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('interests',$this->interests,true);
		$criteria->compare('birdthday',$this->birdthday,true);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('odnoklassniki',$this->odnoklassniki,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('params',$this->params,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}