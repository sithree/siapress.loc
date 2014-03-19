<?php
$this->breadcrumbs = array(
    'Articles' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Article', 'url' => array('index')),
    array('label' => 'Create Article', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    input[type="text"], textarea {
        width: 100%;
        padding: 4px 0;
        margin-bottom: 4px;
    }
</style>
<div class="block-outer">
    <div class="block">
        <div class="block-inner">
            <h1>Управление записями</h1>

            <div class="row-fluid">
                <div class="span12">
                    <?php echo Yii::app()->user->checkAccess('administrator')
                            ? $this->renderPartial('_index',array('model' => $model))
                            : $this->renderPartial('_index_official',array('model' => $model)) ?>
                </div>
            </div>
        </div>
    </div>
</div>