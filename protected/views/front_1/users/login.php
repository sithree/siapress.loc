<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>Авторизация</h1>
<hr />
<?php
#$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
?>

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
        <br />
        <div id="loginresult"></div>

        <?php echo CHtml::textField('login', $login, array('class' => 'span10', 'placeholder' => 'Логин')); ?>
        <?php echo CHtml::textField('password', $passswrod, array('class' => 'span10', 'placeholder' => 'Пароль')); ?>
        <label class="checkbox">
            <input type="checkbox" id="save" />
            <label for="save">Запомнить введенные данные </label>
        </label>
        <div class="right" style="font-size: 85%;">
            <a href="#">Забыли пароль?</a> | <a href="#">Регистрация</a>
        </div>


    </div>
</div>
<div class="row-fluid">
    <hr />
    <div class="right">
        <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            'type' => 'danger',
            'label' => 'Авторизоваться',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
    </div>
</div>


<!--
<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
<?php echo $form->labelEx($model, 'username'); ?>
<?php echo $form->textField($model, 'username'); ?>
<?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
<?php echo $form->labelEx($model, 'password'); ?>
<?php echo $form->passwordField($model, 'password'); ?>
<?php echo $form->error($model, 'password'); ?>
        <p class="hint">
            Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
        </p>
    </div>

    <div class="row rememberMe">
<?php echo $form->checkBox($model, 'rememberMe'); ?>
<?php echo $form->label($model, 'rememberMe'); ?>
<?php echo $form->error($model, 'rememberMe'); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton('Login'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
