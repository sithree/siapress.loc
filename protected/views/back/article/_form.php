<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'article-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        ));
?>
<?php Yii::app()->clientScript->registerCss('t','body {padding-bottom: 45px;}') ?>
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
        <?php
        /*
          $this->widget('ext.redactorjs.Redactor', array(
          'model' => $model,
          'attribute' => 'fulltext',
          'lang' => 'ru',
          'editorOptions' => array(
          'imageUpload' => Yii::app()->createAbsoluteUrl('article/imageupload'),
          'imageGetJson' => Yii::app()->createAbsoluteUrl('article/uploadedImages'),
          'removeStyles' => true,
          'removeClasses' => true,
          'autoresize' => false,
          'resizeImage' => false,
          'buttons' => array('formatting'),
          //                'initCallback' =>CJavaScript::encode( new CJavaScriptExpression(
          //                        "function()
          //        {
          //            var callback = function(buttonName, buttonDOM, buttonObj, e)
          //            {
          //                this.execCommand('underline');
          //            }
          //
          //            // add after
          //            this.buttonAddAfter('italic', 'underline', 'Underline', callback);
          //
          //            // add before
          //            this.buttonAddBefore('image', 'button1', 'Button Before', function(buttonName, buttonDOM, buttonObj, e) {
          //                alert(buttonName);
          //            });
          //
          //            // add separator after or before
          //            this.buttonAddSeparatorAfter('button1');
          //        }"
          //                        ), false),
          # 'formattingTags' => array('p'),
          'fixed' => false,
          # 'fixedTop' => 50,
          #'fixedBox' => true,
          ),
          ));
         * 
         */
        ?>

        <?php echo $form->textFieldRow($model, 'tags', array('class' => 'span12', 'maxlength' => 255)); ?>

        <?php echo $form->textFieldRow($model, 'imgtitle', array('class' => 'span12', 'maxlength' => 255)); ?>

    </div>
    <div class="span4">

        <?php echo $form->dropDownListRow($model, 'cat_id', CHtml::listData(ArticleCategories::model()->list()->findAll(), 'id', 'name'), array('class' => 'span12')); ?>
        <?php echo $form->dropDownListRow($model, 'author', $model->getAuthorsArray(), array('class' => 'span12')); ?>
        <?php echo $form->textFieldRow($model, 'author_alias', array('class' => 'span12', 'maxlength' => 255)); ?>

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
        <?php echo $form->label($model, 'modified'); ?>
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'modified',
            'language' => 'ru', //default Yii::app()->language
            //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:m:s', //'hh:mm tt' default
            ),
                )
        );
        ?>
        <?php echo $form->fileFieldRow($model, 'image') ?>

        <?php echo $form->checkBoxRow($model, 'published'); ?>
        <?php echo $form->checkBoxRow($model, 'main'); ?>
        <?php echo $form->checkBoxRow($model, 'main_category'); ?>
        <?php echo $form->checkBoxRow($model, 'comment_on'); ?>
        <?php echo $form->checkBoxRow($model, 'top'); ?>
        <?php echo $form->checkBoxRow($model, 'query'); ?>
        <?php echo $form->hiddenField($model, 'type_id', array('value' => 1)); ?>
        <hr />
        <?php echo $model->image(); ?>

        <?php echo $form->checkBoxRow($model, 'deleteImage', array('value' => 1)); ?>

        <hr />
        <?php echo $form->textFieldRow($model, 'video', array('class' => 'span11')); ?>


        <div id="videoPositions">


            <?php
            for ($i = 0; $i < count($videos); $i++):
                $this->renderPartial('_videoPositions', array('model' => $videos[$i], 'index' => $i));
            endfor;
            ?>
        </div>

        <script>
            $('a.addPlayerTime').click(function() {

                $.ajax({
                    success: function(html) {
                        $('#videoPositions').append(html);
                    },
                    type: "get",
                    url: '<?php echo $this->createUrl('ajax/videoPositionForm') ?>',
                    data: {index: $("#videoPositions div.vpindex").size()},
                    cache: false,
                    dataType: "html"
                });

                //videoPositions
                return false;

            });

        </script>
    </div>
</div>

<div class="form-actions"  style="position: fixed; bottom: 0px; width: 100%; left: 0px; margin-bottom: 0px; padding: 10px 15px;">
    <div class='container'>
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
</div>
<?php $this->endWidget(); ?>
