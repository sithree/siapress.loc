<?php
$likeOr = $comment->commentAdd->like - $comment->commentAdd->dislike;
if ($likeOr > 0)
{
    $like = '+' . $likeOr;
    $class = 'green';
} elseif ($likeOr < 0)
{
    $like = $likeOr;

    $class = 'red';
} else
{
    $class = 'green';
    $like = $likeOr;
}
?>
<!-- noindex -->

<div id="d<?php echo $comment['id'] ?>" <?php echo $new ? 'class="new"' : ''; ?> >
    <a class="comment-id" rel="" name="comment-<?php echo $comment['id'] ?>"></a>
    <div id="c<?php echo $comment['id'] ?>" style="padding: 0;" class="comment <?php echo $comment['level'] > 0 ? "comment-inner-" . $comment['level'] : '' ?>">
        <div class="comment-header" style="margin-bottom: 5px; position: relative">
            <?php if ($comment->author->login_from == 2): ?>
                <div class="comment-ava">
                    <img src="<?php echo Users::model()->getAvatarFilename(50, false, $comment['author_id']); ?>" alt="" />
                </div>
                <?php
            else:
//            <!--
//                <div class="comment-ava">
//                    <img src="images/users/noava.jpg" alt="" />
//                </div>
//            -->
            endif;
            ?>
            <div class="comment-says" style="margin-bottom:5px;padding-top: 10px;">
                <?php if ($comment->author->login_from == 2): ?>
                    <i style="float:left; margin-right: 5px; background: url(images/icons/vk.gif) no-repeat bottom; display: block; width: 16px; height: 16px;"></i>
                    <span class="comment-author" style="font-weight: bold;color: #ca0000; ">
                        <?php echo $comment->name; ?>
                    </span>
                <?php else: ?>
                    <span class="comment-author" style="font-weight: bold;color: #ca0000; ">
                        <?php echo $comment->name; ?>                                             
                    </span>
                    <span/>

                    <?php if (!empty($comment->parent)): ?>
                        <span> 
                            <?php
                            $parent = Comment::model()->findByPk($comment->parent);
                            echo ' <span style="color:#333; font-weight:normal;">  <a class="fromComment" data-from-id="' . $parent->id . '" rel="tooltip" title="' . mb_substr(strip_tags($parent->text), 0, 200, 'UTF-8') . '..." style="border-bottom: 1px dotted #CA0000;" href="' . Yii::app()->request->requestUri . '#comment-' . $parent->id . '">&rarr;</a> </span> <b>' . $parent->name . '</b>';
                            ?>
                        </span>
                    <?php endif;
                    ?>

                <?php endif; ?>
                    <div style="float:right; font-size:11px;"><a rel="<?php echo $comment->id ?>" class="replyComment" style="font-weight:normal;" href="<?php echo $replyUrl.'?parent='.$comment->id ?>#addcomment">Ответить</a></div>
            </div>
            <div class="1234" style="float:right">
                <?php if (!Yii::app()->request->cookies['comment_' . $comment->id]->value AND ! isset(Yii::app()->session['comment_' . $comment->id])): ?>
                    <a class="likebutton" rel="<?php echo $comment->id ?>" title="Нравится" href="#"><i class="fa fa-thumbs-up"></i> нравится</a>
                    <a class="dislikebutton"  rel="<?php echo $comment->id ?>" title="Не нравится" href="#"><i class="fa fa-thumbs-down"></i> не нравится</a>
                    <span id="<?php echo $comment->id ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                <?php else: ?>
                    <span id="<?php echo $comment->id ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                <?php endif; ?>
            </div>

            <div class="comment-links">
                <span class="comment-date" style="font-size:100%; float: none; display: inline"><?php echo Helper::getFormattedtime($comment->created) ?></span>
                <?php
                if (Yii::app()->user->checkAccess('administrator'))
                    echo '| '.CHtml::link('Бан на сутки', Yii::app()->createUrl('comment/ban', array('id' => $comment->id, 'token' => $comment->token)));
                ?>
            </div>

            <div class="clr"></div>
        </div>
        <div class="comment-inner <?php echo ($likeOr <= -5) ? 'badComment' : '' ?>" style="position:relative;<?php
        echo ($likeOr <= -5) ? 'opacity:0.8; color:#aaa;' : '';
        echo $comment->best ? 'border-color: #ca0000;' : ''
        ?>" >
                 <?php
                 if (Yii::app()->user->checkAccess('administrator'))
                 {
                     if ($comment->ban != 0 || $comment->published == 0)
                     {
                         echo "<div style='color:#aaa;'> " . $comment->replace() . "</div>";
                     } else
                         echo $comment->replace();
                 }
                 else
                 {
                     if ($comment->ban)
                         echo $comment->getBanText();
                     else
                         echo $comment->replace();
                 }
                 ?>


            <?php if (Yii::app()->user->checkAccess('administrator')) : ?>
                <div class="adminCommentBtns">
                    <?php
                    if ($comment->published == 1):
                        if ($comment->best)
                            echo CHtml::link('Не лучший', Yii::app()->createUrl('comment/makeTheBest', array('id' => $comment->id, 'token' => $comment->token, 'value' => 0)));
                        else
                            echo CHtml::link('Лучший', Yii::app()->createUrl('comment/makeTheBest', array('id' => $comment->id, 'token' => $comment->token, 'value' => 1)));
                        if ($comment->ban != 0)
                            echo CHtml::link('Снять', Yii::app()->createUrl('comment/markBan', array('id' => $comment->id, 'token' => $comment->token, 'value' => 0)));
                        else
                            echo "<span>Снять</span>";
                        if ($comment->ban != 1)
                            echo CHtml::link('Нарушает', Yii::app()->createUrl('comment/markBan', array('id' => $comment->id, 'token' => $comment->token, 'value' => 1)));
                        else
                            echo "<span>Нарушает</span>";
                        if ($comment->ban != 2)
                            echo CHtml::link('Оскорбляет', Yii::app()->createUrl('comment/markBan', array('id' => $comment->id, 'token' => $comment->token, 'value' => 2)));
                        else
                            echo "<span>Оскорбляет</span>";
                        if ($comment->ban != 3)
                            echo CHtml::link('Не в тему', Yii::app()->createUrl('comment/markBan', array('id' => $comment->id, 'token' => $comment->token, 'value' => 3)));
                        else
                            echo "<span>Не в тему</span>";
                    endif;

                    if ($comment->published)
                        echo CHtml::link('Удалить', Yii::app()->createUrl('comment/markPublished', array('id' => $comment->id, 'token' => $comment->token, 'value' => 0)));
                    else
                        echo CHtml::link('Опубликовать', Yii::app()->createUrl('comment/markPublished', array('id' => $comment->id, 'token' => $comment->token, 'value' => 1)));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--/noindex-->