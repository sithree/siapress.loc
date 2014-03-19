<?php

/**
 * This is the model class for table "{{banners}}".
 *
 * The followings are the available columns in table '{{banners}}':
 * @property integer $id
 * @property integer $position
 * @property string $start
 * @property string $end
 * @property string $img
 * @property string $code
 * @property string $link
 * @property integer $client_id
 * @property integer $publish
 * @property string $key
 * @property integer $width
 * @property integer $height
 *
 * The followings are the available model relations:
 * @property BannerStat $bannerStat
 * @property BannerClients $client
 */
class Banner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
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
		return '{{banners}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position, start, client_id, key', 'required'),
			array('position, client_id, publish, width, height', 'numerical', 'integerOnly'=>true),
			array('img, link', 'length', 'max'=>255),
			array('key', 'length', 'max'=>32),
			array('end, code', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, position, start, end, img, code, link, client_id, publish, key, width, height', 'safe', 'on'=>'search'),
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
			'bannerStat' => array(self::HAS_ONE, 'BannerStat', 'banner_id'),
			'client' => array(self::BELONGS_TO, 'BannerClients', 'client_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'position' => 'Position',
			'start' => 'Start',
			'end' => 'End',
			'img' => 'Img',
			'code' => 'Code',
			'link' => 'Link',
			'client_id' => 'Client',
			'publish' => 'Publish',
			'key' => 'Key',
			'width' => 'Width',
			'height' => 'Height',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('position',$this->position);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getlink(){
        #return Yii::createUrl('link');
    }
}