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
        <?php $template = '<div class="radio clearfix">
                                <i class="fa fa-circle-o votecircle"></i>
                                <div class="poll_r">
                                {input}
                                {label}
                                </div>
                            </div>'; ?>
        <?php
        
        echo $form->hiddenField($userVote,'choice_id');
        
        echo $form->radioButtonList($userVote, 'choice_id', $choices, array(
            'template' => $template,
            'separator' => '',
            'name' => 'PortletPollVote_choice_id_' . $model->id));
        ?>
        <?php echo $form->error($userVote, 'choice_id'); ?>
    </div>

    <div class="right" style="display: none;">
        <?php echo CHtml::submitButton('Голосовать', array('class' => 'btn btn-danger')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>