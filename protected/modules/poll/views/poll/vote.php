<div class="poll-content">
    <div class="widget gray-border-light main-news poll">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'portlet-poll-form',
            'enableAjaxValidation' => false,
        ));
        ?>


        <?php echo $form->errorSummary($model); ?>

        <div class="vote">
            <?php $template = '<div class="radio clearfix">
                                <i class="fa fa-circle-o votecircle"></i>
                                <div class="poll_r">
                                {input}
                                {label}
                                </div>
                            </div>'; ?>
            <?php
            echo $form->hiddenField($model, 'id');
            echo $form->radioButtonList($vote, 'choice_id', $choices, array(
                'template' => $template,
                'separator' => ''));
            ?>
            <?php echo $form->error($vote, 'choice_id'); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>