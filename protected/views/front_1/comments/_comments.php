<?php
$likeOr = $comment->commentAdd->like - $comment->commentAdd->dislike;
if ($likeOr > 0) {
    $like = '+' . $likeOr;
    $class = 'green';
} elseif ($likeOr < 0) {
    $like =$likeOr;

    $class = 'red';
}
else {
    $class = 'green';
    $like =$likeOr;
}
?>
<!-- noindex -->


<div id="d<?php echo $comment['id'] ?>">
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

                    <?php if (!empty($comment->parent)): ?>
                        <span> 
                            <?php
                            $parent = Comment::model()->findByPk($comment->parent);
                            echo ' <span style="color:#333; font-weight:normal;">в ответ на <a class="fromComment" data-from-id="' . $parent->id . '" rel="tooltip" title="' . mb_substr(strip_tags($parent->text), 0, 200, 'UTF-8') . '..." style="border-bottom: 1px dotted #CA0000;" href="' . Yii::app()->request->requestUri . '#comment-' . $parent->id . '">комментарий</a> от пользователя</span> <b>' . $parent->name . '</b>';
                            ?>
                        </span>
                    <?php endif;
                    ?>

                <?php endif; ?>
                <div style="float:right; font-size:11px;"><a rel="<?php echo $comment['id'] ?>" class="replyComment" style="font-weight:normal;" href="<?php echo Yii::app()->request->requestUri ?>#addcomment">Ответить</a></div>
            </div>
            <div class="1234" style="float:right">

                <?php if (!Yii::app()->request->cookies['comment_' . $comment->id]->value AND !isset(Yii::app()->session['comment_' . $comment->id])): ?>
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
        <div class="comment-inner <?php echo ($likeOr <= -5) ? 'badComment' : '' ?>" style="position:relative;<?php echo ($likeOr <= -5) ? 'opacity:0.8; color:#aaa;' : '' ?>" >
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


            <?php
            if (Yii::app()->user->checkAccess('administrator')) :
                Yii::app()->clientScript->registerCss('adminCommentBtns', '
                .adminCommentBtns {
                background: none repeat scroll 0 0 #EEEEEE;
    bottom: -17px;
    font-size: 10px;
    padding: 0 8px;
    position: absolute;
    right: -1px;
}
');
                ?>
                <div class="adminCommentBtns">
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
                        echo "&nbsp;&nbsp;&nbsp;";
                        echo CHtml::ajaxLink('Оскорбляет', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'author', 'token' => $comment->token)), array(
                            'type' => 'get',
                            'cache' => false,
                            'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                ), array('style' => $comment->ban == 2 ? 'text-decoration:underline;' : '')
                        );
                        echo "&nbsp;&nbsp;&nbsp;";
                        echo CHtml::ajaxLink('Не в тему', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'theme', 'token' => $comment->token)), array(
                            'type' => 'get',
                            'cache' => false,
                            'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                                ), array('style' => $comment->ban == 3 ? 'text-decoration:underline;' : '')
                        );
                    endif;
                    echo "&nbsp;&nbsp;&nbsp;";

                    echo CHtml::ajaxLink('Удалить', $this->createUrl('comment/moderator', array('id' => $comment->id, 'action' => 'delete', 'token' => $comment->token)), array(
                        'type' => 'get',
                        'cache' => false,
                        'success' => "function(html){
                                    jQuery('#d" . $comment->id . "').html(html);
                                 }"
                            ), array('style' => $comment->published == 0 ? 'text-decoration:underline;' : '')
                    );
                    echo "&nbsp;&nbsp;&nbsp;";

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
        </div>
    </div>
</div>
<!--/noindex-->