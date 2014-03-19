<?php

/**
 * This is the model class for table "{{articles}}".
 *
 * The followings are the available columns in table '{{articles}}':
 * @property integer $id
 * @property string $title
 * @property integer $cat_id
 * @property integer $published
 * @property string $introtext
 * @property string $fulltext
 * @property string $tags
 * @property integer $author
 * @property string $author_alias
 * @property integer $modif_by
 * @property string $created
 * @property string $modified
 * @property string $publish
 * @property string $metakey
 * @property integer $main
 * @property integer $type_id
 * @property integer $comment_on
 * @property string $imgtitle
 *
 * The followings are the available model relations:
 * @property ArticleAdd $articleAdd
 * @property Users[] $siaUsers
 * @property ArticleTypes $type
 * @property ArticleCategories $cat
 * @property Users $author0
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return '{{articles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, cat_id, fulltext, author, created, modified, publish, type_id', 'required'),
			array('cat_id, published, author, modif_by, main, type_id, comment_on', 'numerical', 'integerOnly'=>true),
			array('title, tags, author_alias, metakey, imgtitle', 'length', 'max'=>255),
			array('introtext', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, cat_id, published, introtext, fulltext, tags, author, author_alias, modif_by, created, modified, publish, metakey, main, type_id, comment_on, imgtitle', 'safe', 'on'=>'search'),
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
			'articleAdd' => array(self::HAS_ONE, 'ArticleAdd', 'article_id'),
			'siaUsers' => array(self::MANY_MANY, 'Users', '{{article_users}}(article_id, user_id)'),
			'type' => array(self::BELONGS_TO, 'ArticleTypes', 'type_id'),
			'cat' => array(self::BELONGS_TO, 'ArticleCategories', 'cat_id'),
			'author0' => array(self::BELONGS_TO, 'Users', 'author'),
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
			'cat_id' => 'Cat',
			'published' => 'Published',
			'introtext' => 'Introtext',
			'fulltext' => 'Fulltext',
			'tags' => 'Tags',
			'author' => 'Author',
			'author_alias' => 'Author Alias',
			'modif_by' => 'Modif By',
			'created' => 'Created',
			'modified' => 'Modified',
			'publish' => 'Publish',
			'metakey' => 'Metakey',
			'main' => 'Main',
			'type_id' => 'Type',
			'comment_on' => 'Comment On',
			'imgtitle' => 'Imgtitle',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('published',$this->published);
		$criteria->compare('introtext',$this->introtext,true);
		$criteria->compare('fulltext',$this->fulltext,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('author_alias',$this->author_alias,true);
		$criteria->compare('modif_by',$this->modif_by);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('publish',$this->publish,true);
		$criteria->compare('metakey',$this->metakey,true);
		$criteria->compare('main',$this->main);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('comment_on',$this->comment_on);
		$criteria->compare('imgtitle',$this->imgtitle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}