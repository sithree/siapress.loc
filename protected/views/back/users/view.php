<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Users','url'=>array('index')),
	array('label'=>'Create Users','url'=>array('create')),
	array('label'=>'Update Users','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Users','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users','url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'name',
		'firstname',
		'lastname',
		'middlename',
		'caption_text',
		'caption',
		'password',
		'email',
		'active',
		'vk_id',
		'tw_id',
		'fb_id',
		'login_from',
		'perm_id',
		'last_visit',
		'register_date',
		'block',
		'token',
		'status',
		'phone',
		'address',
		'level',
		'occupation',
		'about',
		'moderation',
	),
)); ?>
