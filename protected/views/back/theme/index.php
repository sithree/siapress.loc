<?php
$this->breadcrumbs=array(
	'Themes',
);

$this->menu=array(
	array('label'=>'Create Theme','url'=>array('create')),
	array('label'=>'Manage Theme','url'=>array('admin')),
);
?>

<h1>Themes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
