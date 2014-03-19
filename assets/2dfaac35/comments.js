jQuery(function($) {

    $('.likebutton').click(function(){
       var t = $(this);
        $.ajax({
            'type':'POST',
           // 'id':'morenewsbutton',
            'beforeSend':function(){
            },
            'complete':function(){
            },
            'success':function(html){
                t.parent('.1234').html(html);
            },
            'url':'/ajax/likecomment',
            'cache':false,
            'data':'id=' + t.attr('rel') +'&type=like'
        });
        return false;
    });
    $('.dislikebutton').click(function(){
       var t = $(this);
        $.ajax({
            'type':'POST',
            //'id':'morenewsbutton',
            'beforeSend':function(){
            },
            'complete':function(){
            },
            'success':function(html){
                t.parent('.1234').html(html);
            },
            'url':'/ajax/likecomment',
            'cache':false,
            'data':'id=' + t.attr('rel') +'&type=dislike'
        });
        return false;
    });

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