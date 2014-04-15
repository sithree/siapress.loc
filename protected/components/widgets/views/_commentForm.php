<?php
if (1 == 2):
    echo '	<div class="span12">Оставить комментарий может только зарегистрированный пользователь. <a href="/registration">Регистрация</a> или <a href="/login">авторизация</a>.</div>';
else :
    ?>

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
        <?php $this->render('application.views.front.comments._form', array('commentform' => $commentform, 'object_id' => $object_id, 'object_type_id' => $object_type_id)); ?>
    </div>
<?php endif; ?>
<p style="font-size: 11px;"> <br />Комментарий может быть удален, если он: не по сути текста; оскорбляет автора,
    героев или читателей; не соответствует <a href="rules">правилам сайта</a>.</p>



<script>
    var refreshId;
    function fadeInComment()
    {
        $('.new').css('display', 'none');
        $('.new').fadeIn(1000, function() {
            $('.new').removeClass('new');
        });
    }

    function refreshComments() {
        var commentContainer = $('#commentContainer');
        var id = commentContainer.children().last().attr('id');
        if (id === undefined) {
            $('#lastCommentId').val(0);
        } else {
            $('#lastCommentId').val(id.substring(1, 7));
        }
        form = $('#CommentForm');
        $.ajax({
            url: '/comment/loadlast', // указываем URL и
            type: "POST",
            cache: false,
            data: form.serialize(),
            success: function(html) { // вешаем свой обработчик на функцию success
                commentContainer = $('#commentContainer');
                commentContainer.append(html);
                fadeInComment();
            }
        });
    }

    $(document).on('click', '.adminCommentBtns a', function() {
        link = $(this);
        link.parent().find('.adminCommentBtns a').prop('disabled', true);
        $.ajax({
            url: $(this).attr('href'), // указываем URL и
            type: "GET",
            cache: false,
            success: function(html) { // вешаем свой обработчик на функцию success
                link.parents('.comment').parent().replaceWith(html);
            }
        });
        return false;
    });

    $(document).on('click', '#sendComment', function() {
        clearInterval(refreshId);
        $(this).prop('disabled', true);
        var commentContainer = $('#commentContainer');
        var id = commentContainer.children().last().attr('id');
        if (id === undefined) {
            $('#lastCommentId').val(0);
        } else {
            $('#lastCommentId').val(id.substring(1, 7));
        }
        form = $('#CommentForm');
        $.ajax({
            url: '/comment/add', // указываем URL и
            type: "POST",
            cache: false,
            dataType: 'json',
            data: form.serialize(),
            success: function(result) { // вешаем свой обработчик на функцию success
                $('#commentFormBlock').html(result.form);
                commentContainer = $('#commentContainer');
                commentContainer.append(result.comments);
                fadeInComment();
                refreshId = setInterval(refreshComments, 5000);
            }
        });
    });
    refreshId = setInterval(refreshComments, 5000);
</script>