<?php
$this->breadcrumbs=array(
	'User News'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List UserNews','url'=>array('index')),
	array('label'=>'Create UserNews','url'=>array('create')),
	array('label'=>'Update UserNews','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete UserNews','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserNews','url'=>array('admin')),
);
?>

<h1>View UserNews #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'user_name',
		'user_email',
		'user_phone',
		'title',
		'fulltext',
		'link',
	),
)); ?>
