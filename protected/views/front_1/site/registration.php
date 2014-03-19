<?php
$this->pageTitle = Yii::app()->name . ' - Регистрация';
$this->breadcrumbs = array(
    'Login',
);
?>

<?php echo $this->renderPartial('application.views.front.ajax.registrationAjax',
        array('model' => $model, 'noAjax'=> true)); ?>





