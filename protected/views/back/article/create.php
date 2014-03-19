<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>Добавить запись</h1>

<?php
if (Yii::app()->user->checkAccess('administrator') or Yii::app()->user->checkAccess('author_sia') or
        Yii::app()->user->checkAccess('author')){
    echo $this->renderPartial('_form', array('model' => $model, 'videos' => $videos));
} elseif (Yii::app()->user->checkAccess('official')){
    echo $this->renderPartial('_form_official', array('model' => $model));
}
