<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'type' => 'inline',
    'id' => 'CommentForm',
    'action' => 'comment/add',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )
        ));
echo CHtml::hiddenField('lastCommentId');
echo $form->hiddenField($comment, 'object_id');
echo $form->hiddenField($comment, 'object_type_id');
?>

<div class="well no-margin">
    <?php echo $message; ?>
    <?php if (Yii::app()->user->isGuest): ?>
        <div clas="row-fluid">
            <p id="reply-to">
                <?php if ($comment->parent): ?>
                    В ответ на комментарий от пользователя <b><?php echo $comment->editable->name ?></b> <a id="deleteReply" style="font-size:10px;" href="<?php echo Yii::app()->createUrl('', array('comment' => 'removeparent', 'objectTypeId' => $comment->object_type_id, 'objectId' => $comment->object_id)) ?>#addcomment">[отменить]</a>
                <?php endif; ?>
            </p>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-xs-6">
                <?php echo $form->textFieldRow($comment, 'name', array('class' => 'col-xs-12 no-margin')); ?>
                <?php echo $form->error($comment, 'name'); ?>
            </div>
        </div>
    <?php else: ?>

        <p id="reply-to">
            <?php if ($comment->parent): ?>
                В ответ на комментарий от пользователя <b><?php echo $comment->editable->name ?></b> <a id="deleteReply" style="font-size:10px;" href="<?php echo Yii::app()->createUrl('', array('comment' => 'removeparent', 'objectTypeId' => $comment->object_type_id, 'objectId' => $comment->object_id)) ?>#addcomment">[отменить]</a>
            <?php endif; ?>
        </p>

    <?php
    endif;
    ?>

    <div class="row" style="margin-bottom: 10px;">
        <?php if (Yii::app()->user->isGuest): ?>

            <div class="col-xs-12">
                <?php echo $form->textAreaRow($comment, 'text', array('class' => 'col-xs-12 no-margin', 'rows' => 5, 'value' => Yii::app()->request->cookies[$object_id . '_comment_text']->value)); ?>
                <?php echo $form->error($comment, 'text'); ?>
            </div>


        <?php else: ?>
            <div class="col-xs-12">
                <?php echo $form->textAreaRow($comment, 'text', array('class' => 'col-xs-12 no-margin', 'rows' => 5, 'value' => Yii::app()->request->cookies[$object_id . '_comment_text']->value)); ?>
                <?php echo $form->error($comment, 'text'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <?php if (Yii::app()->user->isGuest): ?>
                
                <?php echo $form->textFieldRow($comment, 'capcha', array('class' => 'col-xs-12 no-margin', 'value' => Yii::app()->request->cookies['comment_capcha']->value)); ?>
                <?php echo $form->error($comment, 'capcha'); ?>
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
            <?php echo CHtml::submitButton('Отправить', array('class' => 'col-xs-12 no-margin red-button small-btn', 'id' => 'sendComment')) ?>
            <?php echo $form->hiddenField($comment, 'parent'); ?>
        </div>
    </div>
</div>
<?php
$this->endWidget();
