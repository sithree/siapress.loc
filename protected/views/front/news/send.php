<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'type' => 'vertical',
    'id' => 'user-news-form',
    'enableAjaxValidation' => false
        ));
?>
<div class="row" style="margin-bottom: 10px;">


    <?php // echo $form->errorSummary($model); ?>
    <?php if (Yii::app()->user->isGuest): ?>
        <div class="col-xs-6">
            <?php echo $form->textFieldRow($model, 'user_name', array('class' => 'col-xs-12 no-margin', 'maxlength' => 255)); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $form->textFieldRow($model, 'user_email', array('class' => 'col-xs-12 no-margin', 'maxlength' => 255)); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $form->textFieldRow($model, 'user_phone', array('class' => 'col-xs-12 no-margin', 'maxlength' => 20)); ?>
        </div>
    <?php endif; ?>
    <div class="col-xs-12">
        <?php echo $form->textFieldRow($model, 'title', array('class' => 'col-xs-12 no-margin', 'maxlength' => 255)); ?>
    </div>
    <div class="col-xs-12">
        <?php echo $form->textAreaRow($model, 'fulltext', array('rows' => 12, 'cols' => 20, 'class' => 'col-xs-12 no-margin')); ?>
    </div>
    <div class="col-xs-12">
        <?php echo $form->textFieldRow($model, 'link', array('class' => 'col-xs-12 no-margin', 'maxlength' => 255)); ?>
    </div>
    <?php if (extension_loaded('gd') && Yii::app()->user->isGuest): ?>
        <div class="col-xs-7">
            <?php echo $form->textFieldRow($model, 'captcha', array('class' => 'col-xs-12 no-margin')); ?>
        </div>
        <div class="col-xs-5">
            <?php
            $this->widget('CCaptcha', array(
                'clickableImage' => true,
                'showRefreshButton' => false,
            ))
            ?>
        </div>
    <?php endif ?>
</div>
<div class="col-xs-8">
    <p class="help-block"><span class="required">*</span>Поля необходимо заполнить.</p>
</div>
<div class="col-xs-4">
    <?php echo CHtml::submitButton('Отправить', array('class' => 'col-xs-12 no-margin red-button small-btn')); ?>
</div>


<?php $this->endWidget(); ?>
