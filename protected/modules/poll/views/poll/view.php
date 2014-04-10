<?php
/* @var $model Poll */
/* @var $head string */
$this->renderPartial($head, array('model' => $model));
if ($model->userCanVote()) {
    $choices = array();
    foreach ($model->choices as $choice) {
        $choices[$choice->id] = CHtml::encode($choice->label);
    }
    echo $this->renderPartial('vote', array('model' => $model, 'choices' => $choices, 'vote' => new PollVote()));
} else {
    echo $this->renderPartial('results', array('model' => $model));
}?>
<a id="comments"></a>
<?php if (count($comments) > 0): ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии:</div>
<?php else: ?>
    <div style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментариев пока нет.</div>
<?php endif; ?>


<?php
if (count($comments) > 0) {
    $this->renderPartial('application.views.front.comments.comments', array(
        'comments' => $comments,
    ));
}
?>
<hr />
<!-- Форма добавления комментария -->
<?php if (isset($commentform)): ?>
    <a id="addcomment"></a>
    <?php
    $this->renderPartial('application.views.front.comments._form', array(
        'commentform' => $commentform,
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