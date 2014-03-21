<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Theme','url'=>array('index')),
	array('label'=>'Create Theme','url'=>array('create')),
	array('label'=>'Update Theme','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Theme','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Theme','url'=>array('admin')),
);
?>

<h1>View Theme #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'active',
		'alias',
	),
)); ?>
