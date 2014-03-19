<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Административная часть';
?>

<style>
    body {
        background: #f4f4f4;
    }
    .block-outer {
        background: white;
        padding: 2px;
        border:#dfdfdf 1px solid;
        box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.1);
    }
    .block-inner {
        padding: 15px;
        border:#f1f1f1 1px solid;
    }
    input.span12 {
        margin-bottom: 10px;
    }
    .center {
        text-align: center;
    }
    .form-inline {
        margin-bottom: 5px;
    }
</style>
<div class="block-outer">
    <div class="block">
        <div class="block-inner">
            <p style="text-align: center;"><img src="images/logo.png"></p>
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'login-form',
                'type' => 'inline',
                'focus' => array($model, 'username'),
                'enableClientValidation' => false,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                ),
                    ));
            ?>

            <div class="row-fluid">
                <div class="span1"></div>
                <div class="span10">
                    <div id="loginresult" style="color:#ca0000; margin-bottom: 10px; font-weight: bold;">
                        <?php
                            echo Yii::app()->user->getFlash('error');
                        ?>
                    </div>
                    <?php echo $form->textFieldRow($model, 'username', array('class' => 'span12')); ?>
                    <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12')); ?>

                    <?php echo $form->checkBoxRow($model, 'rememberMe', array()); ?>
                </div>
                <div class="span1"></div>
            </div>
            <div class="row-fluid" style="margin-top: 15px;">
                <div class="center">
                    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'danger', 'label' => 'Авторизоваться')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>