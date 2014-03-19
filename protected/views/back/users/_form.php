<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'users-form',
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class="span4">
        <div class="row-fluid">
            <div class="span6">
                <?php echo $form->textFieldRow($model, 'username', array('class' => 'span12', 'maxlength' => 100)); ?>
            </div>
            <div class="span6">
                <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12', 'maxlength' => 60,'value' => '')); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <?php echo $form->textFieldRow($model, 'firstname', array('class' => 'span12', 'maxlength' => 100)); ?>
            </div>
            <div class="span6">
                <?php echo $form->textFieldRow($model, 'lastname', array('class' => 'span12', 'maxlength' => 100)); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <?php echo $form->textFieldRow($model, 'middlename', array('class' => 'span12', 'maxlength' => 100)); ?>
            </div>
            <div class="span6">
                <?php echo $form->textFieldRow($model, 'email', array('class' => 'span12', 'maxlength' => 100)); ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <?php echo $form->dropDownListRow($model, 'perm_id', CHtml::listData(UserPermiss::model()->findAll(), 'id', 'name'), array('class' => 'span12')); ?>
        <?php echo $form->textFieldRow($model, 'caption_text', array('class' => 'span12', 'maxlength' => 255)); ?>
        <?php echo $form->textFieldRow($model, 'register_date', array('class' => 'span12', 'value' => date('Y-m-d H:i:s'))); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span12', 'maxlength' => 50)); ?>
        <?php echo $form->textFieldRow($model, 'address', array('class' => 'span12', 'maxlength' => 255)); ?>
        <?php echo $form->checkBoxRow($model, 'block'); ?>
        <?php echo $form->checkBoxRow($model, 'active'); ?>
        <?php echo $form->checkBoxRow($model, 'moderation'); ?>
        <?php echo $form->checkBoxRow($model, 'caption'); ?>
    </div>
</div>

<?php echo $form->hiddenField($model, 'vk_id', array('class' => 'span12', 'value' => (string)"0")); ?>
<?php echo $form->hiddenField($model, 'tw_id', array('class' => 'span12', 'value' => (string)"0")); ?>
<?php echo $form->hiddenField($model, 'fb_id', array('class' => 'span12', 'value' => (string)"0")); ?>
<?php echo $form->hiddenField($model, 'status', array('class' => 'span12', 'value' => 1)); ?>
<?php echo $form->hiddenField($model, 'last_visit', array('class' => 'span12', 'value' => date('Y-m-d H:i:s'))); ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Сохранить',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
