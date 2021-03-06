<h1>Manage Polls</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php // $this->renderPartial('_search',array(
//  'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'poll-grid',
  'dataProvider'=>$model->search(),
  'filter'=>$model,
  'columns'=>array(
    'title',
    'description',
    array(
      'name' => 'status',
      'value' => 'CHtml::encode($data->getStatusLabel($data->status))',
      'filter' => CHtml::activeDropDownList($model, 'status', $model->statusLabels()),
    ),
    array(
      'class'=>'CButtonColumn',
    ),
  ),
)); ?>
