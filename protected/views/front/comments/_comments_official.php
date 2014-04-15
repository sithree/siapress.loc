<?php
$like = $comment->commentAdd->like - $comment->commentAdd->dislike;
if ($like > 0)
{
    $like = '+' . $like;
    $class = 'green';
} elseif ($like < 0)
{
    $class = 'red';
} else
    $class = 'green';

$ava = 'images/users/official/' . $comment->author->id . '.jpg';
?>
<!--noindex-->
<div id="d<?php echo $comment['id'] ?>" <?php echo $new ? 'class="new"' : "" ?>>
    <a class="comment-id" rel="" name="comment-<?php echo $comment['id'] ?>"></a>
    <div id="c<?php echo $comment['id'] ?>" style="padding: 0;" class="comment <?php echo $comment['level'] > 0 ? "comment-inner-" . $comment['level'] : '' ?>">
        <div class="comment-header" style="margin-bottom: 5px; position: relative">
<?php if (is_file($ava)): ?>
                <div class="comment-ava" style="width:120px; height: 100%;">
                    <img src="<?php echo $ava; ?>" alt="<?php echo CHtml::encode($comment->author->name) ?>" />
                </div>
<?php else: ?>
                <div class="comment-ava">
                    <img src="images/users/noava.jpg" alt="" />
                </div>
                    <?php endif; ?>
            <div class="comment-says" style="margin-bottom:5px;padding-top: 0;">
                <span class="comment-author" style="font-weight: bold;font-size: 90%; color: #ca0000; ">
<?php echo CHtml::encode($comment->author->name) ?>
                </span><br />
                <span class="comment-date" style="float:none;"><?php echo CHtml::encode($comment->author->caption_text) ?></span>
            </div>
                <?php if ($comment->ban == 0): ?>
                <div class="1234" style="float:right;">
    <?php if (!Yii::app()->request->cookies['comment_' . $comment->id]->value): ?>
                        <span id="<?php echo $comment->id ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                        <a class="likebutton" rel="<?php echo $comment->id ?>" title="Нравится" style="display:inline-block; height: 15px" href="#"><i class="like"></i></a>
                        <a class="dislikebutton"  rel="<?php echo $comment->id ?>" title="Не нравится" href="#"><i class="dislike"></i></a>
                    <?php else: ?>
                        <span id="<?php echo $comment->id ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                <?php endif; ?>
                </div>
<?php endif; ?>

            <div class="comment-links">
                <span class="comment-date" style="font-size:100%; float: none; display: inline"><?php echo Helper::getFormattedtime($comment->created) ?></span>
                <?php if ($comment->ban != 0 AND 1 == 2): ?>
                    | <a rel="<?php echo $comment->id ?>" class="reply-link" href="#">Ответить</a>

<?php endif; ?>
            </div>

            <div class="clr"></div>
        </div>
        <div class="comment-inner">
            <?php
            if ($comment->ban)
                echo $comment->getBanText();
            else
                echo $comment->text;
            ?>
        </div>
    </div>
</div>
<!--/noindex-->
