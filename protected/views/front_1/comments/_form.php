<?php
if (1 == 2):
    echo '	<div class="span12">Оставить комментарий может только зарегистрированный пользователь. <a href="/registration">Регистрация</a> или <a href="/login">авторизация</a>.</div>';
else :
    ?>

    <h4>Оставить комментарий</h4>
    <br />
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


    <div class="well well-light">
        <div class="row-fluid">
            <div class="span12">

                <?php if (Yii::app()->user->isGuest): ?>
                    <div clas="row-fluid">
                        <p id="reply-to"></p>
                    </div>
                    <div class="row-fluid" style="margin-bottom: 10px;">
                        <div class="span6">
                            <?php echo $form->textFieldRow($commentform, 'username', array('class' => 'span12','value' => Yii::app()->request->cookies['comment_username']->value)); ?>
                            <?php echo $form->error($commentform, 'username'); ?>
                        </div>
                        <div class="span6">
                            <?php #echo $form->textFieldRow($commentform, 'email', array('class' => 'span12'));   ?>
                            <?php #echo $form->error($commentform, 'email'); ?>
                        </div>
                    </div>
                <?php else: ?>
                <div clas="row-fluid">
                        <p id="reply-to"></p>
                    </div>
                <?php
                endif;
                ?>


                <!--
                <div class="row-fluid" style="margin-bottom: 3px;">
                    <div class="span12">
                <?php
                /*
                  $this->widget('bootstrap.widgets.BootButtonGroup', array(
                  'buttons' => array(
                  array('label' => '', 'url' => '#', 'icon' => 'align-left',
                  'htmlOptions' => array('title' => 'Выравнивание по левому краю')),
                  array('label' => '', 'url' => '#', 'icon' => 'align-center',
                  'htmlOptions' => array('title' => 'Выравнивание по центру')),
                  array('label' => '', 'url' => '#', 'icon' => 'align-right',
                  'htmlOptions' => array('title' => 'Выравнивание по правому краю')),
                  array('label' => '', 'url' => '#', 'icon' => 'italic',
                  'htmlOptions' => array('title' => 'Курсив')),
                  array('label' => '', 'url' => '#', 'icon' => 'bold',
                  'htmlOptions' => array('title' => 'Жирный')),
                  array('label' => '', 'url' => '#', 'icon' => 'picture',
                  'htmlOptions' => array('title' => 'Вставить картинку')),
                  array('label' => '', 'url' => '#', 'icon' => 'comment',
                  'htmlOptions' => array('title' => 'Вставить цитату')),
                  ),
                  )); */
                ?>
                    </div>
                </div>
                -->
                <div class="row-fluid" style="margin-bottom: 10px;">
                    <?php if (Yii::app()->user->isGuest): ?>

                        <div class="span12">
                            <?php echo $form->textAreaRow($commentform, 'text', array('class' => 'span12', 'rows' => 5,'value' => Yii::app()->request->cookies[$model->id . '_comment_text']->value)); ?>
                            <?php echo $form->error($commentform, 'text'); ?>
                        </div>


                    <?php else: ?>
                        <div class="span1">
                            <img src="<?php echo Users::model()->getAvatarFilename(50, false, Yii::app()->user->id); ?>" alt="" />
                        </div>
                        <div class="span11">
                            <?php echo $form->textAreaRow($commentform, 'text', array('class' => 'span12', 'rows' => 5,'value' => Yii::app()->request->cookies[$model->id . '_comment_text']->value)); ?>
                            <?php echo $form->error($commentform, 'text'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <?php if (Yii::app()->user->isGuest): ?>
                            <?php echo $form->textFieldRow($commentform, 'capcha', array('class' => 'span12','value' => Yii::app()->request->cookies['comment_capcha']->value)); ?>
                            <?php echo $form->error($commentform, 'capcha'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="span3">
                        <? if (extension_loaded('gd') && Yii::app()->user->isGuest): ?>
                            <?
                            #$this->captcha->showRefreshButton
                            $this->widget('CCaptcha', array(
                                'clickableImage' => true,
                                'showRefreshButton' => false,
                            ))
                            ?>
                        <? endif ?>
                        <?php #echo $form->captchaRow($commentform, 'capcha')  ?>
                    </div>
                    <div class="span5">
                        <?php #$form->submitButton($commentform)    ?>
                        <?php #echo CHtml::submitButton('Сохранить');  ?>
                        <?php echo $form->hiddenField($commentform, 'parent'); ?>
                        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'icon' => 'ok white', 'label' => 'Отправить', 'htmlOptions' => array('class' => 'span12 btn-danger'))); ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <p style="font-size: 11px;"> <br />Комментарий может быть удален, если он: не по сути текста; оскорбляет автора,
                            героев или читателей; не соответствует <a href="rules">правилам сайта</a>.</p>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
<?php endif; ?>
<hr />

<?php include($_SERVER['DOCUMENT_ROOT'] . '/profit_partner/comments.txt'); ?>