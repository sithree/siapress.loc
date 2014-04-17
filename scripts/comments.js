jQuery(function($) {

    $(document).on('click', '.likebutton', function() {
        var t = $(this);
        $.ajax({
            'type': 'POST',
            'success': function(html) {
                t.parent('.1234').html(html);
            },
            'url': '/comment/likecomment',
            'cache': false,
            'data': 'id=' + t.attr('rel') + '&type=like'
        });
        return false;
    });

    $(document).on('click', '.dislikebutton', function() {
        var t = $(this);
        $.ajax({
            'type': 'POST',
            'success': function(html) {
                t.parent('.1234').html(html);
            },
            'url': '/ajax/likecomment',
            'cache': false,
            'data': 'id=' + t.attr('rel') + '&type=dislike'
        });
        return false;
    });

    var refreshId;
    var refreshInterval = 15000;
    function fadeInComment() {
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

    function scrollTo(target) {
        jTarget = $("a[name='" + target + "']");
        destination = jTarget.offset().top;
        root = $.browser.safari ? $('body') : $('html');
        root.animate({
            scrollTop: destination
        },
        Math.abs(root.scrollTop() - destination) / 10,
                function() {
                    jTargetContent = jTarget.next();
                    jTargetContent.animate({
                        opacity: 0.4
                    },
                    1000,
                    function() {
                        jTargetContent.animate({
                            opacity: 1
                        },
                        1000);
                    });
                    document.location.hash = target;
                });
    }
    
    $(document).on('click', '.fromComment', function(){
        scrollTo('comment-' + $(this).attr('data-from-id'));
        return false;
    });

    $(document).on('click', '.adminCommentBtns a', function() {
        link = $(this);
        link.prop('disabled', true);
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
                refreshId = setInterval(refreshComments, refreshInterval);
            }
        });
    });
    refreshId = setInterval(refreshComments, refreshInterval);

    $(document).on('click', 'a.replyComment', function() {
        rel = $(this).attr('rel');
        parent = $(this).parents('#d' + rel);
        user = parent.find('.comment-author').text();
        replyTo = $('#reply-to');
        replyTo.html('В ответ на комментарий от пользователя <b>' + user + '</b> <a id="deleteReply" style="font-size:10px;" href="#">[отменить]</a>');
        $('#CommentForm_parent').val(rel);
        scrollTo('addcomment');
        return false;
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