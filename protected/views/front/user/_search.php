<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'vk_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'tw_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fb_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'login_from',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'perm_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'last_visit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'register_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'block',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
