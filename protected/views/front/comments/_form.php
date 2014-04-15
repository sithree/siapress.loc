<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'type' => 'inline',
    'id' => 'CommentForm',
    #'htmlOptions' => array('class' => 'well'),
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )
        ));
echo CHtml::hiddenField('lastCommentId');
$commentform->object_id = $object_id;
$commentform->object_type_id = $object_type_id;
echo $form->hiddenField($commentform, 'object_id');
echo $form->hiddenField($commentform, 'object_type_id');
?>

<div class="well no-margin">

    <?php if (Yii::app()->user->isGuest): ?>
        <div clas="row-fluid">
            <p id="reply-to"></p>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-xs-6">
                <?php echo $form->textFieldRow($commentform, 'username', array('class' => 'col-xs-12 no-margin', 'value' => Yii::app()->request->cookies['comment_username']->value)); ?>
                <?php echo $form->error($commentform, 'username'); ?>
            </div>
        </div>
    <?php else: ?>

        <p id="reply-to"></p>

    <?php
    endif;
    ?>

    <div class="row" style="margin-bottom: 10px;">
        <?php if (Yii::app()->user->isGuest): ?>

            <div class="col-xs-12">
                <?php echo $form->textAreaRow($commentform, 'text', array('class' => 'col-xs-12 no-margin', 'rows' => 5, 'value' => Yii::app()->request->cookies[$object_id . '_comment_text']->value)); ?>
                <?php echo $form->error($commentform, 'text'); ?>
            </div>


        <?php else: ?>
            <div class="col-xs-12">
                <?php echo $form->textAreaRow($commentform, 'text', array('class' => 'col-xs-12 no-margin', 'rows' => 5, 'value' => Yii::app()->request->cookies[$object_id . '_comment_text']->value)); ?>
                <?php echo $form->error($commentform, 'text'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <?php if (Yii::app()->user->isGuest): ?>
                <?php echo $form->textFieldRow($commentform, 'capcha', array('class' => 'col-xs-12 no-margin', 'value' => Yii::app()->request->cookies['comment_capcha']->value)); ?>
                <?php echo $form->error($commentform, 'capcha'); ?>
            <?php endif; ?>
        </div>
        <div class="col-xs-3">
            <?php if (extension_loaded('gd') && Yii::app()->user->isGuest): ?>
                <?php
                $this->widget('CCaptcha', array(
                    'clickableImage' => true,
                    'showRefreshButton' => false,
                    'captchaAction' => '/comment/captcha'
                ))
                ?>
            <?php endif ?>
        </div>
        <div class="col-xs-5">
            <?php echo CHtml::button('Отправить', array('class' => 'col-xs-12 no-margin red-button small-btn', 'id' => 'sendComment')); ?>
            <?php echo $form->hiddenField($commentform, 'parent'); ?>

            <?php // $this->widget('bootstrap.widgets.BootButton', array('buttonType' => '', 'icon' => 'ok white', 'label' => 'Отправить', 'htmlOptions' => array('class' => 'col-xs-12 red-button')));  ?>
        </div>
    </div>
</div>
    <?php
    $this->endWidget();
    