<a id="comments"></a>
<?php if (count($comments) > 0): ?>
    <div id="commentTitle" style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментарии:</div>
<?php else: ?>
    <div id="commentTitle" style="margin-bottom: 15px; font-size:14px; font-weight: bold;">Комментариев пока нет.</div>
<?php endif; ?>

<div id="commentContainer">
    <?php
    foreach ($comments as $commentItem) {
        $params['comment'] = $commentItem;
        if ($commentItem->author->perm_id == 6)
            $this->render('application.views.front.comments._comments_official', $params);
        else
            $this->render('application.views.front.comments._comments', $params);
    }
    ?>
</div>
<hr />
<!-- Форма добавления комментария -->
<?php if (isset($comment) AND Yii::app()->params->comments == true and $this->comment_on == 1): ?>
    <a name="addcomment"></a>
    <h4 class="fwnormal">Оставить комментарий</h4>
    <?php
    $this->widget('bootstrap.widgets.BootAlert', array(
        'keys' => 'info'
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.BootAlert', array(
        'keys' => 'error'
    ));
    ?>
    <div id="commentFormBlock">
        <?php 
        $params['comment'] = $comment;
        $this->render('application.views.front.comments._form', $params); ?>
    </div>
    <p style="font-size: 11px;"> <br />Комментарий может быть удален, если он: не по сути текста; оскорбляет автора,
        героев или читателей; не соответствует <a href="rules">правилам сайта</a>.</p>
    <?php
else:
    if (empty($model['comment_ban'])):
        ?>
        <h3>Комментарии закрыты.</h3>
    <?php else: ?>
        <h3><?php echo $model['comment_ban'] ?></h3>
    <?php endif; ?>
<?php endif; ?>