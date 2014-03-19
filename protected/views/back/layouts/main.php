<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin.php" />

        <!-- Le styles -->

        <style type="text/css">
            body {
                padding-top: 45px;
                padding-bottom: 45px;
            }
        </style>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
        <?php  Yii::app()->clientScript->registerCssFile('/css/admin.css');?>
    </head>

    <body>
        <?php echo Yii::app()->user->checkAccess('administrator')
                            ? $this->renderPartial('application.views.back.layouts._menu',array('model' => $model))
                            : $this->renderPartial('application.views.back.layouts._menu_official',array('model' => $model)) ?>

        <div class="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>
