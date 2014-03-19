<?php

/**
 * This is the model class for table "{{comment_migrate}}".
 *
 * The followings are the available columns in table '{{comment_migrate}}':
 * @property integer $old_comment_id
 * @property integer $new_comment_id
 */
class CommentMigrate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommentMigrate the static model class
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
		return '{{comment_migrate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('old_comment_id, new_comment_id', 'required'),
			array('old_comment_id, new_comment_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('old_comment_id, new_comment_id', 'safe', 'on'=>'search'),
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
			'old_comment_id' => 'Old Comment',
			'new_comment_id' => 'New Comment',
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

		$criteria->compare('old_comment_id',$this->old_comment_id);
		$criteria->compare('new_comment_id',$this->new_comment_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}