<?php include 'head.php'; ?>

<?php $this->widget('application.components.main.mbanner', array('position' => 13)); ?>

<div class="row-fluid">
    <div class="span6">
        <?php echo $content; ?>
    </div>
    <div class="span3">
        <?php include 'column2.php'; ?>
    </div>
    <div class="span3">
        <?php include 'column3.php'; ?>
    </div>
</div>
<?php include 'footer.php'; ?>