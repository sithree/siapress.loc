<?php if (!isset($noAjax)): ?>
    <script type="text/javascript">
        jQuery(function($){
            $('#myModal').css({overflow: 'hidden'});
            $('#myModal').animate({
                width: 500,
                height: 655,
                marginTop: -333,
                marginLeft: -250
            }, 500, function(){
                $('.modal-body').animate({
                    'opacity': 1
                }, 400);
                $(this).css({overflow: 'auto'});
            });

            $('.close').click(function(){
                window.location.replace(window.location);
            });
        });
    </script>
    <style>
        body {
            overflow: hidden;
        }
        #myModal{
            height: 350PX;
        }
        .modal-body {
            max-height: 1200px;
            overflow-y: hidden;
            padding: 15px;
            opacity: 0;
        }
        #rules-block .control-group .controls {
            margin-left: 0px;
        }
        #rules-block .control-group {
            margin-bottom: 0px;
        }
        #regForm {
            margin-bottom: 0;
        }
    </style>

<?php else: ?>

    <style type="text/css">
        .modal-body {
            height: auto;
            max-height: 100%;
        }
        .close {
            display: none;
        }

    </style>
<?php endif; ?>
<style type="text/css">

    .help-inline.error {
        font-size: 11px;
        padding: 0;
        display: block;
        height: 0px;
        visibility: hidden;
    }
    label.error  {
        color:#B94A48;
    }

</style>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3 style="font-weight: normal;">Регистрация<h3/></div>
<div class="modal-body">
    <div id="request"></div>

    <div class="row-fluid">
        <div class="span12">
            <?php
            $form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
                'id' => 'registration-form',
                'type' => 'horizontal',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('style' => 'margin: 0px;'),
                    ));
            ?>
            <?php echo isset($noAjax) ? $form->errorSummary($model, '') : ''; ?>
            <div class="well well-reg" id="regForm">
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $form->textFieldRow($model, 'lastname', array('class' => 'span12')); ?>
                        <?php echo $form->textFieldRow($model, 'firstname', array('class' => 'span12')); ?>
                        <?php echo $form->textFieldRow($model, 'middlename', array('class' => 'span12')); ?>

                        <?php echo $form->textFieldRow($model, 'login', array('class' => 'span12')); ?>
                        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12')); ?>

                        <?php
                        echo $form->textFieldRow($model, 'email', array('class' => 'span12',
                        ));
                        ?>

                        <?php echo $form->dropDownListRow($model, 'caption', array(1 => 'Имя Фамилия', 2 => 'Ник')); ?>
                        <div id="rules-block">
                            <div class="control-group" style="margin-bottom: 5px;">
                                <textarea style="text-align: justify; padding: 9px 7px 6px;font:12px/14px 'Trebuchet MS','Helvetica','Arial',sans-serif; border: 1px solid #DADFE6;width: 95%; height: 50px;">Даю свое согласие ЗАО "СМИА СИА-ПРЕСС" (ЗАО "Сургутское молодежное информационное агентство СИА-ПРЕСС", далее &ndash; Информационное агентство, адрес: ул. Бульвар Свободы 1, Сургут, ХМАО-Югра, Россия) на обработку Информационным агентством  моих персональных данных, указанных в настоящей и др. формах, размещенных на страницах Информационного агентства, включая сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, передачу партнерам Информационного агентства в целях исполнения обязательств Информационного агентства или донесения информационных материалов, обезличивание, блокирование, уничтожение персональных данных.
Уполномачиваю Информационное агентство предоставлять информацию о своих персональных данных третьей стороне, с которой у Информационного агентства заключен договор, содержащий условия по обеспечению конфиденциальности, в целях осуществления телематической связи со мной для передачи информационных и рекламных сообщений Информационного агентства или в целях осуществления курьерской доставки.
Настоящее согласие действует в течение пяти лет с даты подачи настоящей Заявки. По истечении указанного срока действие согласия считается продленным на каждые следующие пять лет при отсутствии сведений о его отзыве.
Настоящее согласие на обработку моих персональных данных может быть отозвано мной путем подачи письменного или электронного уведомления в Информационное агентство не менее чем за 3 месяца до момента отзыва согласия при условии, что на момент отзыва согласия между мной и Информационным агентством не будет действующих договорных отношений.
                                </textarea>
                            </div>

                            <?php echo $form->checkBoxRow($model, 'agree'); ?>
                            <?php echo $form->checkBoxRow($model, 'rules'); ?>
                        </div>
                        <div style="text-align: center">

                            <?php
//                            echo CHtml::ajaxSubmitButton(
//                                    'Зарегистрироваться',
//                                    array('site/registration'),
//                                    array(
//                                        'type' => 'POST',
//                                        )
//                                    );

                            $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'danger', 'icon' => 'arrow-right white', 'label' => 'Зарегистрироваться')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<?php echo CHtml::endForm(); ?>
