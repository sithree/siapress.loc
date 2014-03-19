<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);


$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('style' => 'margin: 0px;'),
        ));
?>
<h1>Авторизация</h1>
<hr />
<?php echo $form->errorSummary($model,''); ?>

<div class="row-fluid">
    <div class="span6">
        <h4>Войти как пользователь</h4>
        <br />
        <?php
            $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
        ?>
    </div>
    <div class="span6">
        <h4>Войти по логину СИА-ПРЕСС</h4>

        <?php echo $form->error($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('class' => 'span10', 'placeholder' => 'Логин или Email')); ?>

        <?php echo $form->error($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('class' => 'span10', 'placeholder' => 'Пароль')); ?>

        <label class="checkbox">
            <?php echo $form->checkBox($model, 'rememberMe'); ?>
            <?php echo $form->label($model, 'rememberMe'); ?>
            <?php echo $form->error($model, 'rememberMe'); ?>
        </label>


        <div class="right" style="font-size: 85%;">
            <!-- <a href="#">Восстановление пароля</a> |--> <?php echo CHtml::link('Регистрация', array('site/registration')); ?>
        </div>
    </div>
</div>
<div class="row-fluid">
    <hr />
    <div class="right">
        <?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-danger', 'rel' => 'politics',)); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>

