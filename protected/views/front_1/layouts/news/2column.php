<?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'head.php'; ?>

<?php $this->widget('application.components.main.mbanner', array('position' => 13)); ?>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="span9">
                <?php $this->widget('application.components.main.mbanner', array('position' => 2)); ?>
            <?php echo $content  ?>
        </div>
        <div class="span3">
            <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column3.php'; ?>
        </div>
    </div>
</div>
<?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'footer.php'; ?>