<?php
$like = $comment->commentAdd->like - $comment->commentAdd->dislike;
if ($like > 0) {
    $like = '+' . $like;
    $class = 'green';
} elseif ($like < 0) {
    $class = 'red';
}
else
    $class = 'green';
?>
<!-- noindex -->
    <a class="comment-id" rel="" name="comment-<?php echo $comment['id'] ?>"></a>
    <div id="c<?php echo $comment['id'] ?>" style="padding: 0;" class="comment <?php echo $comment['level'] > 0 ? "comment-inner-" . $comment['level'] : '' ?>">
        <div class="comment-header" style="margin-bottom: 5px; position: relative">
            <?php if ($comment->author->login_from == 2): ?>
                <div class="comment-ava">
                    <img src="<?php echo Users::model()->getAvatarFilename(50, false, $comment['author_id']); ?>" alt="" />
                </div>
            <?php else: ?>
                <div class="comment-ava">
                    <img src="images/users/noava.jpg" alt="" />
                </div>
            <?php endif; ?>
            <div class="comment-says" style="margin-bottom:5px;padding-top: 10px;">
                <?php if ($comment->author->login_from == 2): ?>
                    <i style="float:left; margin-right: 5px; background: url(images/icons/vk.gif) no-repeat bottom; display: block; width: 16px; height: 16px;"></i>
                    <span class="comment-author" style="font-weight: bold;font-size: 90%; color: #ca0000; ">
                        <?php echo $comment->name; ?>
                    </span>
                <?php else: ?>
                    <span class="comment-author" style="font-weight: bold;font-size: 90%; color: #ca0000; ">
                        <?php echo $comment->name; ?>
                    </span>
                <?php endif; ?>

            </div>
            <div class="1234" style="float:right">
                <?php if (Yii::app()->user->checkAccess('administrator')) : ?>
                    <div style="position:absolute; right:0; top:3px;">
                        <?php
                        if ($comment->published == 1):
                            echo CHtml::ajaxLink('Нарушает', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'rules', 'token' => $comment->token)), array(
                                'type' => 'get',
                                'cache' => false,
                                'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                    ), array('style' => $comment->ban == 1 ? 'text-decoration:underline;' : '')
                            );
                            echo "&nbsp;&nbsp;";
                            echo CHtml::ajaxLink('Оскорбляет', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'author', 'token' => $comment->token)), array(
                                'type' => 'get',
                                'cache' => false,
                                'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                    ), array('style' => $comment->ban == 2 ? 'text-decoration:underline;' : '')
                            );
                            echo "&nbsp;&nbsp;";
                            echo CHtml::ajaxLink('Не в тему', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'theme', 'token' => $comment->token)), array(
                                'type' => 'get',
                                'cache' => false,
                                'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                    ), array('style' => $comment->ban == 3 ? 'text-decoration:underline;' : '')
                            );
                        endif;
                        echo "&nbsp;&nbsp;";

                        echo CHtml::ajaxLink('Удалить', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'delete', 'token' => $comment->token)), array(
                            'type' => 'get',
                            'cache' => false,
                            'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                ), array('style' => $comment->published == 0 ? 'text-decoration:underline;' : '')
                        );
                        echo "&nbsp;&nbsp;";

                        echo CHtml::ajaxLink('Опубликовать', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'publish', 'token' => $comment->token)), array(
                            'type' => 'get',
                            'cache' => false,
                            'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                )
                        );
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (!Yii::app()->request->cookies['comment_' . $comment->id]->value): ?>
                    <span id="<?php echo $comment->id ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                    <a class="likebutton" rel="<?php echo $comment->id ?>" title="Нравится" style="display:inline-block; height: 15px" href="#"><i class="like"></i></a>
                    <a class="dislikebutton"  rel="<?php echo $comment->id ?>" title="Не нравится" href="#"><i class="dislike"></i></a>
                <?php else: ?>
                    <span id="<?php echo $comment->id ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                <?php endif; ?>
            </div>

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
            if (Yii::app()->user->checkAccess('administrator')) :
                if ($comment->ban != 0 or $comment->published == 0) {
                    echo "<div style='color:#aaa;'> " . $comment->replace() . "</div>";
                }
                else
                    echo $comment->replace();
            else:
                if ($comment->ban)
                    echo $comment->getBanText();
                else
                    echo $comment->replace();
            endif;
            ?>
        </div>
</div>
<!--/noindex-->