<?php
$this->breadcrumbs=array(
	'User News',
);

$this->menu=array(
	array('label'=>'Create UserNews','url'=>array('create')),
	array('label'=>'Manage UserNews','url'=>array('admin')),
);
?>

<h1>User News</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
