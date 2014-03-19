<?php
#Yii::app()->cache->flush();
$this->layout = '//layouts/news/article';
$this->setPageTitle($model['title'] . ' — ' . Article::model()->getCategoryFullname($model['cat_id'])); #; . Yii::app()->name);
?>

<?php $this->widget('application.components.main.mbanner', array('position' => 7)); ?>
<?php
#echo CHtml::tag('h1', array('class' => 'title'), $model['title'] . ' ' . CHtml::link('', array('news/'), array('class' => 'icon icon-print', 'title' => 'Версия для печати'))
echo CHtml::tag('h1', array('class' => 'title'), $model['title']);
?>
<?php echo strlen($model['introtext']) > 8 ? CHtml::tag('h3', array('class' => 'introtext'), $model['introtext']) : ''; ?>
<hr />
<?php #$this->widget('application.components.main.mbanner', array('position' => 7)); ?>

<?php echo Article::model()->getArticleimage($model); ?>
<?php echo CHtml::tag('div', array('class' => 'fulltext'), $model['fulltext']); ?>
<?php echo CHtml::tag('div', array('class' => 'authorbottom'), Article::model()->getArticleauthor($model)); ?>
<hr />
<b><?php echo Helper::getFormattedtime($model['publish']) ?>  [Сургут]</b>, просмотров: <?php echo ($model['hits']) ? $model['hits'] : 'не известно'; ?>, комментариев: <?php echo $model['comment_count'] ?>
<hr />
<?php $this->widget('application.components.main.mbanner', array('position' => 14)); ?>

<!-- Социальные кнопки -->
<?php include Yii::app()->basePath . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR .  'social' .DIRECTORY_SEPARATOR. 'social.php'; ?>
<!-- End.Социальные кнопки -->


<hr />

<a id="comments"></a>
<?php if ($model['comment_count'] > 0): ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии: <a title="Подписаться на RSS - ленту комментариев этой новости" href="#"><span class="label label-warning">RSS</span></a></div>
<?php else: ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментариев пока нет.</div>
<?php endif; ?>


<?php
if (count($comments > 0)) {
    $this->renderPartial('/comments/comments', array(
        'comments' => $comments,
    ));
}
?>
<hr />

<!-- Форма добавления комментария -->
<?php if (isset($commentform) AND Yii::app()->params->comments == true and $model['comment_on'] == 1): ?>
    <a id="addcomment"></a>
    <?php
    $this->renderPartial('application.views.comments._form', array(
        'commentform' => $commentform,
        'model' => $model
    ));
    else :
    ?>
    <h3>Комментарии закрыты.</h3>
<?php endif; ?>