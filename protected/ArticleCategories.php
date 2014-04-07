<?php

/**
 * This is the model class for table "{{article_categories}}".
 *
 * The followings are the available columns in table '{{article_categories}}':
 * @property integer $id
 * @property string $name
 * @property integer $published
 * @property integer $parent
 * @property string $alias
 * @property string $fullname
 */
class ArticleCategories extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ArticleCategories the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{article_categories}}';
    }

    public function scopes() {
        return array(
            'list' => array(
                'order' => 'id',
                'condition' => 'published = 1',
            ),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, fullname', 'required'),
            array('published, parent', 'numerical', 'integerOnly' => true),
            array('name, fullname', 'length', 'max' => 100),
            array('alias', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, published, parent, alias, fullname', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'published' => 'Published',
            'parent' => 'Parent',
            'alias' => 'Alias',
            'fullname' => 'Fullname',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('published', $this->published);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('fullname', $this->fullname, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getCategoryName($id) {
        
        $model = $this->getFromCache();

        foreach ($model as $key => $value) {
            if ($value['id'] == $id)
                return $value['name'];
        }
        return false;
    }

    public function getCategoryAlias($id) {
        $model = $this->getFromCache();

        foreach ($model as $key => $value) {
            if ($value['id'] == $id)
                return $value['alias'];
        }
        return false;
    }
    
    public function getCategoryParent($id) {
        $model = $this->getFromCache();

        foreach ($model as $key => $value) {
            if ($value['id'] == $id)
                return $value['parent'];
        }
        return false;
    }
    public function getCategoryParentAlias($id) {
        $model = $this->getFromCache();

        foreach ($model as $key => $value) {
            if ($value['id'] == $id)
                return $this->getCategoryAlias ($value['parent']);
        }
        return false;
    }
    
    

    public function getFromCache() {

        $model = Yii::app()->cache->get('ArticleCategories');
        if ($model === false) {
            $model = Yii::app()->db->createCommand('SELECT * FROM ' . $this->tableName())->queryAll();
            Yii::app()->cache->set('ArticleCategories', $model, 3600);
        }
        return $model;
    }

}
