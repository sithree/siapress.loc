<div class="view">


	<?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cat_id')); ?>:</b>
	<?php echo CHtml::encode($data->category->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('introtext')); ?>:</b>
	<?php echo CHtml::encode($data->introtext); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php if($data->author_alias) : ?>
        <?php echo CHtml::encode($data->author_alias); ?>
    <?php else: ?>
        <?php echo CHtml::encode($data->author0->name); ?>
	<?php endif;?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imgtitle')); ?>:</b>
	<?php echo CHtml::encode($data->imgtitle); ?>
	<hr />


</div>