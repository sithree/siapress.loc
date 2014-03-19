
<div class="row-fluid vpindex">
    <div class="span4">
        <div class="row-fluid">
            <div class="span5">
                <?php echo CHtml::activeTextField($model, "[$index]min", array('placeholder' => '00', 'class' => 'span12', 'maxlength' => 2)); ?>
            </div>
            <div class="span2" style="text-align: center;">:</div>
            <div class="span5">
                <?php echo CHtml::activeTextField($model, "[$index]sec", array('placeholder' => '00', 'class' => 'span12', 'maxlength' => 2)); ?>
            </div>    
        </div>
    </div>
    <div class="span7">
        <?php echo CHtml::activeTextField($model, "[$index]title", array('placeholder' => 'Заголовок', 'class' => 'span12', 'maxlength' => 255)); ?>
    </div>
    <div class="span1">
        
       <?php if($index == 0):?>
        <a class="addPlayerTime" href="#"><i class="icon-plus-sign"></i></a>
        <?php endif; ?>
    </div>
</div>
