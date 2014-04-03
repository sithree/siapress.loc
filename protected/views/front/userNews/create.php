<?php
$this->breadcrumbs=array(
	'User News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserNews','url'=>array('index')),
	array('label'=>'Manage UserNews','url'=>array('admin')),
);
?>

<h1>Create UserNews</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>