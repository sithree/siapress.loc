<?php
/* @var $model Poll */
?>
<h1><?php echo CHtml::encode($model->title); ?></h1>
<?php if ($model->description): ?>
<p class="description"><?php echo CHtml::encode($model->description); ?></p>
<?php endif; ?>
<?php echo $content; ?>