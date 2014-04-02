<?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'head.php'; ?>

<div class="row">
    <div class="col-xs-6"  id="center" >
        <?php Yii::beginProfile('$content.php'); ?>
        <?php echo $content; ?>
        <?php Yii::endProfile('$content.php'); ?>
    </div>
    <div  class="col-xs-3" id="left">
        <?php Yii::beginProfile('column3.php'); ?>
        <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column3.php'; ?>
        <?php Yii::endProfile('column3.php'); ?>
    </div>
    <div  class="col-xs-3" id="right">
        <?php Yii::beginProfile('column4.php'); ?>
        <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column4.php'; ?>
        <?php Yii::endProfile('column4.php'); ?>
    </div>
</div>

<?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'footer.php'; ?>