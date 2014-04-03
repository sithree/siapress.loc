<?php
$this->breadcrumbs=array(
	'User News'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserNews','url'=>array('index')),
	array('label'=>'Create UserNews','url'=>array('create')),
	array('label'=>'View UserNews','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserNews','url'=>array('admin')),
);
?>

<h1>Update UserNews <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>