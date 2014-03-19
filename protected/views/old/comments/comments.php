
<style>
    .btn-like {
        background-color: #fbfbfb;
        padding: 2px 5px;
        border-style: none;
        opacity: 0.5;
    }
    .btn-like:hover {
        opacity: 1;
    }
    .like-result {
        font-weight: bold; color:#ca0000; font-size: 110%; display: inline-block;
        height: 14px;
        line-height: 14px;
        vertical-align: top;
        width: 25px;
        margin-right: 8px;
        text-align: right;
    }
    .like {
        display: inline-block;
        width: 15px;
        height: 15px;
        background: url(images/icons/likes.png);
    }
    a:hover .like {
        background: url(images/icons/likes.png)0 15px;
    }
    .dislike {
        display: inline-block;
        width: 15px;
        height: 15px;
        background: url(images/icons/likes.png) 15px 0;
    }
    a:hover .dislike {
        background: url(images/icons/likes.png) 15px 15px;
    }
    .like-result.green {
        color:green;
    }
</style>

<script type="text/javascript">
    jQuery(function($) {

        $('.likebutton').click(function(){
            t = $(this);
            $.ajax({'type':'POST','id':'morenewsbutton',
                'beforeSend':function(){
                },
                'complete':function(){
                },
                'success':function(html){
                    t.parent('.1234').html(html);
                },'url':'/ajax/likecomment','cache':false,'data':'id=' + jQuery(this).attr('rel') +'&type=like' });return false;});
        $('.dislikebutton').click(function(){
            t = $(this);
            $.ajax({'type':'POST','id':'morenewsbutton',
                'beforeSend':function(){
                },
                'complete':function(){
                },
                'success':function(html){
                    t.parent('.1234').html(html);
                },'url':'/ajax/likecomment','cache':false,
                'data':'id=' + jQuery(this).attr('rel') +'&type=dislike'
            });return false;});

        $('a.reply-link').click(function(){
            id = jQuery(this).attr('rel');
            $('.comment-author').each(function(){
                alert($(this).text());
            });
            author = jQuery(this).parent(id).find('.comment-author').html();
            alert(author);
            $('#reply-to').prepend('<p style="font-size:12px; font-weight:bold;">В ответ на <a href="#">комментарий</a> от <a href="#">' + id + '</a></p>');
            return false;
        });
    });


</script>
<?php
if (!empty($comments)):
    foreach ($comments as $comment):
        if ($comment['published'] == 1):
            $like = $comment['like'] - $comment['dislike'];
            if ($like > 0) {
                $like = '+' . $like;
                $class = 'green';
            } elseif ($like < 0) {
                $class = 'red';
            } else
                $class = 'green';
            ?>
            <noindex>
                <a class="comment-id" rel="" name="comment-<?php echo $comment['id'] ?>"></a>
                <div id="c<?php echo $comment['id'] ?>" style="padding: 0;" class="comment <?php echo $comment['level'] > 0 ? "comment-inner-" . $comment['level'] : '' ?>">
                    <div class="comment-header" style="margin-bottom: 5px; position: relative">
                        <?php if ($comment['login_from'] == 2): ?>
                            <div class="comment-ava">
                                <img src="<?php echo Users::model()->getAvatarFilename(50, false, $comment['author_id']); ?>" alt="" />
                            </div>
                        <?php else: ?>
                            <div class="comment-ava">
                                <img src="images/users/noava.jpg" alt="" />
                            </div>
                        <?php endif; ?>
                        <div class="comment-says" style="margin-bottom:5px;padding-top: 10px;">
                            <?php if ($comment['login_from'] == 2): ?>
                                <i style="float:left; margin-right: 5px; background: url(images/icons/vk.gif) no-repeat bottom; display: block; width: 16px; height: 16px;"></i>
                                <span class="comment-author" style="font-weight: bold;font-size: 90%; color: #ca0000; ">
                                    <?php echo $comment['name']; ?>
                                </span>
                            <?php else: ?>
                                <span class="comment-author" style="font-weight: bold;font-size: 90%; color: #ca0000; ">
                                    <?php echo $comment['name']; ?>
                                </span>
                            <?php endif; ?>

                        </div>
                        <?php if ($comment['ban'] == 0): ?>
                            <div class="1234" style="float:right;">
                                <?php if (!Yii::app()->request->cookies['comment_' . $comment['id']]->value): ?>
                                    <span id="<?php echo $comment['id'] ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                                    <a class="likebutton" rel="<?php echo $comment['id'] ?>" title="Нравится" style="display:inline-block; height: 15px" href="#"><i class="like"></i></a>
                                    <a class="dislikebutton"  rel="<?php echo $comment['id'] ?>" title="Не нравится" href="#"><i class="dislike"></i></a>
                                <?php else: ?>
                                    <span id="<?php echo $comment['id'] ?>" class="like-result <?php echo $class ?>"><?php echo $like ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="comment-links">
                            <span class="comment-date" style="font-size:100%; float: none; display: inline"><?php echo Helper::getFormattedtime($comment['created']) ?></span>
                            <?php if ($comment['ban'] != 0 AND 1 == 2): ?>
                                | <a rel="<?php echo $comment['id'] ?>" class="reply-link" href="#">Ответить</a>

                            <?php endif; ?>
                        </div>

                        <div class="clr"></div>
                    </div>
                    <div class="comment-inner">
                        <?php
                        switch ($comment['ban']) {
                            case 1: echo '<span class="commdeleted">Комментарий удален модератором из-за нарушений <a href="/rules">правил сайта</a>.</span>';
                                break;
                            case 2: echo '<span class="commdeleted">Комментарий удален модератором, так как оскорбляет автора и читателей сайта.</span>';
                                break;
                            case 3: echo '<span class="commdeleted">Комментарий удален модератором, так как не по сути материала.</span>';
                                break;
                            default: if ($comment['published'] == 1) {
                                    echo Comment::model()->replace($comment['text']);
                                }
                                break;
                        }
                        ?>
                    </div>
                </div>
            </noindex>
            <?php
        endif;
    endforeach;
endif;
?>
