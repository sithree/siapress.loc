<a id="comments"></a>
<?php if (count($comments) > 0): ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии:</div>
<?php else: ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментариев пока нет.</div>
<?php endif; ?>


<?php
if (count($comments) > 0) {
    $this->render('comment_list', array(
        'comments' => $comments,
    ));
}
?>
<hr />
<!-- Форма добавления комментария -->
<?php if (isset($comment) AND Yii::app()->params->comments == true and $this->comment_on == 1): ?>
    <a id="addcomment"></a>
    <?php
    $this->render('application.views.front.comments._form', array(
        'commentform' => $comment,
        'model' => $model
    ));
else:
    if (empty($model['comment_ban'])):
        ?>
        <h3>Комментарии закрыты.</h3>
    <?php else: ?>
        <h3><?php echo $model['comment_ban'] ?></h3>
    <?php endif; ?>
<?php endif; ?>