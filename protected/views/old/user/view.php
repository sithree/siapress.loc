<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);
?>

<h1><?php echo $model->username; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'email',
		'vk_id',
		'tw_id',
		'fb_id',
		'last_visit',
		'register_date',
	),
)); ?>
