<div class="result">
    <p><?php echo CHtml::encode($choice->label); ?> <span class="percent"><?php echo $percent; ?>%</span></p>
    <div class="progress">
        <div class="bar" style="width: <?php echo $percent; ?>%;"></div>
    </div>
</div>
