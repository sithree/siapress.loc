<div class="widget gray-border-light main-news poll">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'portlet-poll-form',
        'enableAjaxValidation' => false,
    ));
    ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="vote">
        <?php #echo $form->labelEx($userVote, 'choice_id'); ?>
        <?php $template = '<div class="row-choice clearfix"><div class="form-radio">{input}</div><div class="form-label">{label}</div></div>'; ?>
        <?php $template = '<label class="radio">
                                {input}
                                {label}
                            </label>'; ?>
        <?php
        
        echo $form->hiddenField($userVote,'choice_id');
        
        echo $form->radioButtonList($userVote, 'choice_id', $choices, array(
            'template' => $template,
            'separator' => '',
            'name' => 'PortletPollVote_choice_id_' . $model->id));
        ?>
        <?php echo $form->error($userVote, 'choice_id'); ?>
    </div>
<!--
    <div class="right" style="padding-top:10px;border-top:1px solid #eee;">
        <?php echo CHtml::submitButton('Голосовать', array('class' => 'btn btn-danger')); ?>
    </div>-->

    <?php $this->endWidget(); ?>

</div>