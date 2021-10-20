jQuery(function ($) {
    'use strict';

    $('.update-member-account-settings').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serializeArray();

        $.ajax({
            method: 'POST',
            url: profile_update_obj.ajax_url,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', profile_update_obj.nonce);
            },
            data: {
                action : 'update_member_profile',
                security: profile_update_obj.nonce,
                formData : formData
            },
            success: function (r) {
                var response = $.parseJSON(r);
                if(response.Status === false){
                    $('.status-error').html('<p>'+response.message+'</p>');
                }else{
                    $('.status-success').fadeIn(100).html('<p>' + response.message + '</p>');
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
