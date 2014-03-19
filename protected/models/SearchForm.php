<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SearchForm extends CFormModel {

    public $text;
    public $date_start;
    public $date_end;
    public $author;
    public $category;


    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('text, author ,category, date_start,date_end','safe'),
        );
    }


    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'text' => 'Текст поиска',
            'date_start' => 'Дата с ',
            'date_end' => 'по',
            'author' => 'Автор',
            'category' => 'Категория',
        );
    }


}
