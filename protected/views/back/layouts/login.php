<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin.php" />

        <!-- Le styles -->

        <style type="text/css">
            body {
                padding-top: 35px;
                padding-bottom: 15px;
            }
        </style>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">

    </head>

    <body>       
        <div class="container">
            <div class="span3"></div>
            <div class="span6">
                <?php echo $content; ?>
            </div>
            <div class="span3"></div>
        </div>
    </body>
</html>
