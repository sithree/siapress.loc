
<script>
    $(function() {
        $(document).on('click', 'a.replyComment', function() {
            rel = $(this).attr('rel');
            parent = $(this).parents('#d' + rel);
            user = parent.find('.comment-author').text();
            replyTo = $('#reply-to');
            replyTo.html('В ответ на комментарий от пользователя <b>' + user + '</b> <a id="deleteReply" style="font-size:10px;" href="#">[отменить]</a>');
            $('#CommentForm_parent').val(rel);
        });

        $(document).on('click', '#deleteReply', function() {
            $('#CommentForm_parent').val('');
            $('#reply-to').html('');
            return false;
        })

        $(document).on('click', '#fromComment', function() {
            id = $(this).attr('data-from-id');
            block = $('#d' + id);



            block.animate({
                opacity: 0.4, // прозрачность будет 40%
                marginLeft: "-0.6in", // отступ от левого края элемента станет равным 6 дюймам
                marginRight: "0.6in",
                left: -100,
            }, 100, 'swing', function() {
                block.animate({
                    opacity: 1, // прозрачность будет 40%
                    marginLeft: "0", // отступ от левого края элемента станет равным 6 дюймам
                    marginRight: 0,
                }, 500);
            });

        });

       
    });
</script>

<?php

if ($comments):
    foreach ($comments as $comment):
        if ($comment->author->perm_id == 6)
            $this->render('application.views.front.comments._comments_official', array('comment' => $comment));
        else
            $this->render('application.views.front.comments._comments', array('comment' => $comment));
    endforeach;
endif;
?>
