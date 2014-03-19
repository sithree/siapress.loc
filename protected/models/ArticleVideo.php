<?php

/**
 * This is the model class for table "{{articleVideos}}".
 *
 * The followings are the available columns in table '{{articleVideos}}':
 * @property integer $id
 * @property integer $article
 * @property string $title
 * @property integer $start
 * @property integer $end
 * @property integer $sort
 */
class ArticleVideo extends CActiveRecord
{
    public $min;
    public $sec;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{articleVideos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article, title, sec,min', 'required'),
			array('article, start, end, sec,min', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, article, title, start, end', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'article' => 'Статья',
			'title' => 'Заголовок',
			'sec' => 'Секунд',
			'min' => 'Минут',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('article',$this->article);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('start',$this->start);
		$criteria->compare('end',$this->end);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArticleVideo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function defaultScope(){
            return array(
                'order' => 'start',
            );
        }
        
        public function beforeSave(){
            
            $this->start = $this->min * 60 + $this->sec;
            return true;
        }
        public function  afterFind(){
            $this->min = floor($this->start / 60);
            $this->sec = $this->start % 60;
        }
}
