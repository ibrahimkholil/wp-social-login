jQuery(function ($) {
    'use strict';

    $('.join-event-btn').on('click', function (e) {
        
        e.preventDefault();
        
        
        var postId = $(this).attr("data-id");
        var postUrl = $(this).attr("data-action");

        $.ajax({
            method: 'POST',
            url: eventJoinMetaBoxObj.ajax_url,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', eventJoinMetaBoxObj.nonce);
            },
            data: {
                action : 'user_join_meta_box',
                security: eventJoinMetaBoxObj.nonce,
                eventPostId : postId
            },
            success: function (r) {
                var response = $.parseJSON(r);
                console.log(response);
                if(response.Status === false){
                    $('.status-error').html('<p>'+response.message+'</p>');
                }else{
                    $('.status-success').fadeIn(100).html('<p>' + response.message + '</p>');
                    window.location.href = postUrl;

                }
            },
            error: function (r) {
                console.log($.parseJSON(r));
            },
            complete: function () {
                setTimeout(function () {
                    $('.status-success').fadeOut(100);
                }, 400);
            }
        });
    });
});
