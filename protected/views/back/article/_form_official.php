<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'article-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        ));
?>

<p class="help-block">Поля помеченные <span class="required">*</span> обязательны.</p>

<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class="span8">
        <?php echo $form->textFieldRow($model, 'title', array('class' => 'span12')); ?>
        <?php echo $form->textFieldRow($model, 'introtext', array('class' => 'span12')); ?>

        <?php echo $form->label($model, 'fulltext'); ?>

        <?php
        $this->widget('ext.redactor.ERedactorWidget', array(
            'model' => $model,
            'attribute' => 'fulltext',
            'options' => array(
                'imageUpload' => Yii::app()->createAbsoluteUrl('article/imageupload', array(
                    'attr' => 'fulltext'
                )),
                'imageGetJson' => Yii::app()->createAbsoluteUrl('article/uploadedImages'),
            ),
                // Redactor options
        ));
        ?>

        <?php #echo $form->textFieldRow($model, 'tags', array('class' => 'span12', 'maxlength' => 255)); ?>

        <?php echo $form->textFieldRow($model, 'imgtitle', array('class' => 'span12', 'maxlength' => 255)); ?>

    </div>
    <div class="span4">
        <label class="required" for="Article_author">Автор <span class="required">*</span></label>
        <p><strong><?php echo Users::model()->findByPk(Yii::app()->user->id)->name; ?> </strong></p>
        <?php echo $form->hiddenField($model, 'cat_id', array('value' => 9)); ?>

        <label class="required" for="Article_cat_id">Категория <span class="required">*</span></label>
        <p><strong>Блоги, мнения</strong></p>

        <?php echo $form->label($model, 'created'); ?>
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'created',
            'language' => 'ru', //default Yii::app()->language
            //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:m:s', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->label($model, 'publish'); ?>
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'publish',
            'language' => 'ru', //default Yii::app()->language
            //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:m:s', //'hh:mm tt' default
            ),
                )
        );
        ?>
         <hr />
        <?php echo $form->fileFieldRow($model, 'image') ?>

        <?php echo $form->checkBoxRow($model, 'published'); ?>
        <?php echo $form->checkBoxRow($model, 'comment_on'); ?>
        <?php echo $form->hiddenField($model, 'type_id',array('value' => 1)); ?>
        <hr />
        <?php echo $model->image(); ?>

        <?php echo $form->checkBoxRow($model, 'deleteImage',array('value' => 1)); ?>

    </div>
</div>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Сохранить и закрыть',
        'htmlOptions' => array(
            'id' => 'actionButton[]',
            'name' => 'actionButton[]',
            'value' => 'saveClose',
        ),
    ));
    ?>

        <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'link',
        'label' => 'Сохранить',
        'htmlOptions' => array(
            'id' => 'actionButton[]',
            'name' => 'actionButton[]',
            'value' => 'save',
        ),
    ));
    ?>
        <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'link',
        'label' => 'Сохранить и создать новый',
        'htmlOptions' => array(
            'id' => 'actionButton[]',
            'name' => 'actionButton[]',
            'value' => 'saveNew',
        ),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
