<?php include 'head.php'; ?>

<?php $this->widget('application.components.main.mbanner', array('position' => 13)); ?>

<div class="row-fluid">
    <div class="span6">
        <?php Yii::beginProfile('$content.php'); ?>
        <?php echo $content; ?>
        <?php Yii::endProfile('$content.php'); ?>
    </div>
    <div class="span3">
        <?php Yii::beginProfile('column2.php'); ?>
        <?php include 'column2.php'; ?>
        <?php Yii::endProfile('column2.php'); ?>
    </div>
    <div class="span3">
        <?php Yii::beginProfile('column3.php'); ?>
        <?php include 'column3.php'; ?>
        <?php Yii::endProfile('column3.php'); ?>
    </div>
</div>
<?php include 'footer.php'; ?>