<?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'head.php'; ?>

<?php $this->widget('application.components.main.mbanner', array('position' => 13)); ?>

<div class="row-fluid">
    <div class="row-fluid">
        <div class="span9">
            <div class="row-fluid">
                <div class="span12">
                    <?php $this->widget('application.components.main.mbanner', array('position' => 2)); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span8">
                    <?php echo $content; ?>
                </div>
                <div class="span4">
                    <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column2.php'; ?>
                </div>
            </div>
        </div>
        <div class="span3">
            <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column3.php'; ?>
        </div>
    </div>
</div>
<?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'footer.php'; ?>