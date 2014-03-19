<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vk_id')); ?>:</b>
	<?php echo CHtml::encode($data->vk_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_id')); ?>:</b>
	<?php echo CHtml::encode($data->fb_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('login_from')); ?>:</b>
	<?php echo CHtml::encode($data->login_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('perm_id')); ?>:</b>
	<?php echo CHtml::encode($data->perm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_visit')); ?>:</b>
	<?php echo CHtml::encode($data->last_visit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	*/ ?>

</div>