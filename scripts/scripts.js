jQuery(function($) {
    $(".vote .radio").hover(function() {
        $(this).find(".votecircle").addClass('fa-check-circle-o');
        $(this).find(".votecircle").removeClass('fa-circle-o');
    }, function() {
        $(this).find(".votecircle").addClass('fa-circle-o');
        $(this).find(".votecircle").removeClass('fa-check-circle-o');
    });
    $(".vote .radio").click(function() {
        $(this).find('.poll_r input').attr('checked', 'checked');
        var form = $(this).parents("#portlet-poll-form");
        $.ajax({
            url: '/poll/poll/vote', // указываем URL и
            type: "POST",
            cache: false,
            data: form.serialize(),
            success: function(html) { // вешаем свой обработчик на функцию success
                form.parents('.portlet-content').html(html);
            }
        });
        return false;
        //$(this).parents().find("#portlet-poll-form").submit(); //find("input[type='submit']").click();
    });

    //Кнопки у последних комментов
    $('.navii').click(function() {
        rel = $(this).attr('rel');
        if (rel == 'mostreading') {
            $(this).text('читаемые');
            $('[rel="mostcomment"]').text('комментируемые');
            $('[rel="lastcomment"]').text('последние');
        } else
        if (rel == 'lastcomment') {
            $(this).text('последние');
            $('[rel="mostcomment"]').text('комментируемые');
            $('[rel="mostreading"]').text('читаемые');
        } else
        if (rel == 'mostcomment') {
            $(this).text('комментируемые');
            $('[rel="mostreading"]').text('читаемые');
            $('[rel="lastcomment"]').text('последние');
        }

        $('.navii').removeClass('block-header');
        $('.navii').removeClass('active');

        $('.navii').addClass('popular-mini');

        $(this).addClass('block-header');
        $(this).addClass('active');
        $(this).removeClass('popular-mini');
        $('.mtab').css('display', 'none');
        $('#' + rel).css('display', 'block');
        return false;
    });

//            Больше мнений
//    var pageOpinion = 1;
//    $("#moreOpinions").click(function() {
//        $.ajax({
//            url: '/ajax/getopinions', // указываем URL и
//            type: "POST",
//            data: {
//                page: ++pageOpinion,
//            },
//            beforeSend: function() {
//                $(this).addClass("loading");
//            },
//            complete: function() {
//                $(this).removeClass("loading");
//            },
//            success: function(html) { // вешаем свой обработчик на функцию success
//                $('#loadOpinions').append(html);
//            }
//        });
//        return false;
//    });


});

/* ========================================================================
 * Bootstrap: alert.js v3.1.1
 * http://getbootstrap.com/javascript/#alerts
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function($) {
    'use strict';

    // ALERT CLASS DEFINITION
    // ======================

    var dismiss = '[data-dismiss="alert"]'
    var Alert = function(el) {
        $(el).on('click', dismiss, this.close)
    }

    Alert.prototype.close = function(e) {
        var $this = $(this)
        var selector = $this.attr('data-target')

        if (!selector) {
            selector = $this.attr('href')
            selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
        }

        var $parent = $(selector)

        if (e)
            e.preventDefault()

        if (!$parent.length) {
            $parent = $this.hasClass('alert') ? $this : $this.parent()
        }

        $parent.trigger(e = $.Event('close.bs.alert'))

        if (e.isDefaultPrevented())
            return

        $parent.removeClass('in')

        function removeElement() {
            $parent.trigger('closed.bs.alert').remove()
        }

        $.support.transition && $parent.hasClass('fade') ?
                $parent
                .one($.support.transition.end, removeElement)
                .emulateTransitionEnd(150) :
                removeElement()
    }


    // ALERT PLUGIN DEFINITION
    // =======================

    var old = $.fn.alert

    $.fn.alert = function(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.alert')

            if (!data)
                $this.data('bs.alert', (data = new Alert(this)))
            if (typeof option == 'string')
                data[option].call($this)
        })
    }

    $.fn.alert.Constructor = Alert


    // ALERT NO CONFLICT
    // =================

    $.fn.alert.noConflict = function() {
        $.fn.alert = old
        return this
    }


    // ALERT DATA-API
    // ==============

    $(document).on('click.bs.alert.data-api', dismiss, Alert.prototype.close)

}(jQuery);
