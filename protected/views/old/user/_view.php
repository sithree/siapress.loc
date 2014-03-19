<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tw_id')); ?>:</b>
	<?php echo CHtml::encode($data->tw_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_id')); ?>:</b>
	<?php echo CHtml::encode($data->fb_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_from')); ?>:</b>
	<?php echo CHtml::encode($data->login_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('perm_id')); ?>:</b>
	<?php echo CHtml::encode($data->perm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_visit')); ?>:</b>
	<?php echo CHtml::encode($data->last_visit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('register_date')); ?>:</b>
	<?php echo CHtml::encode($data->register_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block')); ?>:</b>
	<?php echo CHtml::encode($data->block); ?>
	<br />

	*/ ?>

</div>