<?php
$this->pageTitle = Yii::app()->name . ' - Регистрация';
$this->breadcrumbs = array(
    'Login',
);

if(Yii::app()->user->hasFlash('register')): ?>
<h3>Подтверждение email</h3>
<br />
<p class="quote"><?php echo Yii::app()->user->getFlash('register'); ?></p>
<hr />
<?php echo $this->renderPartial('_user_level'); ?>

<?php else:

$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'registration-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('style' => 'margin: 0px;'),
        ));
?>

<style type="text/css">
    .form-horizontal .help-block {
        margin-top: 3px;
        font-size: 11px;
        margin-bottom: 0;
    }
    .well {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: whuteSmoke;
        border: 1px solid #EEE;
        border: 1px solid rgba(0, 0, 0, 0.05);
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }
    .control-group.success > label{
        color: #333;
    }
    .control-group.success input, .control-group.success select, .control-group.success textarea {
        color: #333;
        border-color: #CCC;
    }
    .control-group.success .help-block{
        color: #333;
    }
    .help-inline {
        display: inline-block;
        padding-left: 0px;
        vertical-align: middle;
    }
    .control-group.error .help-block {
        color: #333;
    }

    #rules-block .control-group .controls {

        margin-left: 0px;
    }
    #rules-block .control-group {
        margin-bottom: 5px;
    }
    .help-inline.error {
        color:#ca0000;
    }
</style>

<?php echo $this->renderPartial('_user_level'); ?>

<legend>Форма регистрации</legend>
<?php #echo $form->errorSummary($model, ''); ?>
<div class="well">
    <div class="row-fluid">
        <div class="span12">
            <h5>Основыне данные</h5>
            <hr style="margin: 5px 0 18px 0;" />
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">

            <?php
            echo $form->textFieldRow($model, 'username', array('class' => 'span12',
                'hint' => 'Будет отображатся в подписи к вашим комментариям'));
            ?>
            <?php echo $form->textFieldRow($model, 'login', array('class' => 'span12')); ?>
            <?php
            echo $form->textFieldRow($model, 'email', array('class' => 'span12',
                'hint' => 'Необходима для подтверждения регистрации. Только для редакции'));
            ?>
            <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12')); ?>

        </div>
    </div>
</div>
<div class="well">
    <div class="row-fluid">
        <div class="span12">
            <h5>Дополнительные данные</h5>
            <hr style="margin: 5px 0 18px 0;" />
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <?php
            echo $form->textFieldRow($model, 'address', array('class' => 'span12',
                'hint' => 'Город, улица, дом. Доступен только редакции'));
            ?>
            <?php  echo $form->textFieldRow($model, 'phone', array('class' => 'span12', 'hint' => 'Доступен только редакции'));           ?>

            <?php
            echo $form->textFieldRow($model, 'occupation', array('class' => 'span12'));
            ?>
            <?php
            echo $form->textAreaRow($model, 'about', array('class' => 'span12', 'rows' => 3));
            ?>
            <?php
            #echo $form->fileFieldRow($model, 'avatar', array('rows' => 3, 'hint' => 'Фотмат загружаемого файла .jpg, .gif, .png. Размер не более 8Мб.'));
            ?>

        </div>
    </div>
</div>
<div class="well">
    <div class="row-fluid">
        <div class="span12">
            <h5>Правила сайта и персональная информация</h5>
            <hr style="margin: 5px 0 18px 0;" />
        </div>
    </div>
    <div class="row-fluid" id="rules-block">
        <div class="span12">

            <div class="control-group" style="margin-bottom: 5px;">
                <div class="controls">
                    <textarea style="text-align: justify; padding: 9px 7px 6px;font:12px/14px 'Trebuchet MS','Helvetica','Arial',sans-serif; border: 1px solid #DADFE6;width: 95%; height: 120px;">Даю свое согласие ЗАО "СМИА СИА-ПРЕСС" (ЗАО "Сургутское молодежное информационное агентство СИА-ПРЕСС", далее &ndash; Информационное агентство, адрес: ул. Бульвар Свободы 1, Сургут, ХМАО-Югра, Россия) на обработку Информационным агентством  моих персональных данных, указанных в настоящей и др. формах, размещенных на страницах Информационного агентства, включая сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, передачу партнерам Информационного агентства в целях исполнения обязательств Информационного агентства или донесения информационных материалов, обезличивание, блокирование, уничтожение персональных данных.
Уполномачиваю Информационное агентство предоставлять информацию о своих персональных данных третьей стороне, с которой у Информационного агентства заключен договор, содержащий условия по обеспечению конфиденциальности, в целях осуществления телематической связи со мной для передачи информационных и рекламных сообщений Информационного агентства или в целях осуществления курьерской доставки.
Настоящее согласие действует в течение пяти лет с даты подачи настоящей Заявки. По истечении указанного срока действие согласия считается продленным на каждые следующие пять лет при отсутствии сведений о его отзыве.
Настоящее согласие на обработку моих персональных данных может быть отозвано мной путем подачи письменного или электронного уведомления в Информационное агентство не менее чем за 3 месяца до момента отзыва согласия при условии, что на момент отзыва согласия между мной и Информационным агентством не будет действующих договорных отношений.
                    </textarea>
                </div>
            </div>
            <?php echo $form->checkBoxRow($model, 'agree'); ?>
            <?php echo $form->checkBoxRow($model, 'rules'); ?>

        </div>
    </div>

</div>

<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'danger', 'icon' => 'ok white', 'label' => 'Зарегистрироваться')); ?>
<?php $this->endWidget(); ?>
<?php endif; ?>




