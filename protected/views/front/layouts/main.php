<?php include 'head.php' ?>

<div class="row">
    <div class="col-xs-3" id="left">
        <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column1.php' ?>
    </div>
    <div  class="col-xs-6" id="center">
        <?php echo $content; ?>
    </div>
    <div  class="col-xs-3" id="right">
        <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column4.php' ?>
    </div>
</div>

<?php include 'footer.php'; ?>
