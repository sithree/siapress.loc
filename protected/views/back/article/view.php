
<?php
echo CHtml::tag('h1', array('class' => 'title'), $model['title']);
?>
<?php echo strlen($model['introtext']) > 8 ? CHtml::tag('h3', array('class' => 'introtext'), $model['introtext']) : ''; ?>
<hr />

<?php echo Article::model()->getArticleimage($model); ?>
<?php echo CHtml::tag('div', array('class' => 'fulltext'), $model->fulltext); ?>

<?php echo CHtml::tag('div', array('class' => 'authorbottom'), $model->author0->name)  ?>
<div class="clr"></div>
<hr />

<b><?php echo Helper::getFormattedtime($model['publish']) ?>  [Сургут]</b>, просмотров: <?php echo ($model->articleAdd->hits) ? $model->articleAdd->hits : 'не известно'; ?>, комментариев: <?php e#cho $model['comment_count'] ?>
<hr />
