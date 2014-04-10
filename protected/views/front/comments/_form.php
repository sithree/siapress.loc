<?php
if (1 == 2):
    echo '	<div class="span12">Оставить комментарий может только зарегистрированный пользователь. <a href="/registration">Регистрация</a> или <a href="/login">авторизация</a>.</div>';
else :
    ?>

    <h4 class="fwnormal">Оставить комментарий</h4>
    <?php
    $this->widget('bootstrap.widgets.BootAlert', array(
        'keys' => 'info'
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.BootAlert', array(
        'keys' => 'error'
    ));
    ?>
    <?php
#echo Yii::app()->user()->getFlash();

    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'type' => 'inline',
        'id' => 'CommentForm',
        #'htmlOptions' => array('class' => 'well'),
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));

    /*
      $commentform->object_type_id = $model['type_id'];
      $commentform->object_id = $model['id'];
      $commentform->ip = $_SERVER['REMOTE_ADDR'];
      $commentform->author_id = Yii::app()->user->id ? Yii::app()->user->id : 0;
      if(!Yii::app()->user->isGuest){
      $commentform->email =  Yii::app()->user->email ? Yii::app()->user->email : 'NOEMAIL';
      $commentform->username = Yii::app()->user->name ? Yii::app()->user->name : Yii::app()->user->username;
      }

      echo $form->hiddenField($commentform,'object_type_id');
      echo $form->hiddenField($commentform,'object_id');
      echo $form->hiddenField($commentform,'ip');
      echo $form->hiddenField($commentform,'author_id');
      echo $form->hiddenField($commentform,'object_type_id');
      echo $form->hiddenField($commentform,'object_type_id');

      #CVarDumper::dump($commentform);
     */
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
                <div class="col-xs-6">
                    <?php #echo $form->textFieldRow($commentform, 'email', array('class' => 'span12'));   ?>
                    <?php #echo $form->error($commentform, 'email'); ?>
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
                    <?php echo $form->textAreaRow($commentform, 'text', array('class' => 'col-xs-12 no-margin', 'rows' => 5, 'value' => Yii::app()->request->cookies[$model->id . '_comment_text']->value)); ?>
                    <?php echo $form->error($commentform, 'text'); ?>
                </div>


            <?php else: ?>
<!--                <div class="col-xs-2">
                    <img src="<?php //echo Users::model()->getAvatarFilename(50, false, Yii::app()->user->id); ?>" alt="" />
                </div>-->
                <div class="col-xs-12">
                    <?php echo $form->textAreaRow($commentform, 'text', array('class' => 'col-xs-12 no-margin', 'rows' => 5, 'value' => Yii::app()->request->cookies[$model->id . '_comment_text']->value)); ?>
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
                #$this->captcha->showRefreshButton
                $this->widget('CCaptcha', array(
                'clickableImage' => true,
                'showRefreshButton' => false,
                ))
                ?>
                <?php endif ?>
                <?php #echo $form->captchaRow($commentform, 'capcha')  ?>
            </div>
            <div class="col-xs-5">
                <?php #$form->submitButton($commentform)    ?>
                <?php echo CHtml::submitButton('Отправить', array('class' => 'col-xs-12 no-margin red-button small-btn'));  ?>
                <?php echo $form->hiddenField($commentform, 'parent'); ?>
               
                <?php // $this->widget('bootstrap.widgets.BootButton', array('buttonType' => '', 'icon' => 'ok white', 'label' => 'Отправить', 'htmlOptions' => array('class' => 'col-xs-12 red-button'))); ?>
            </div>
        </div>

       


        <?php $this->endWidget(); ?>
    </div>
<?php endif; ?>
     <p style="font-size: 11px;"> <br />Комментарий может быть удален, если он: не по сути текста; оскорбляет автора,
            героев или читателей; не соответствует <a href="rules">правилам сайта</a>.</p>

     

<?php // include($_SERVER['DOCUMENT_ROOT'] . '/profit_partner/comments.txt'); ?>