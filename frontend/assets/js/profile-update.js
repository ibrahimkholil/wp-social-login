jQuery(function ($) {
    'use strict';
    $(document).on('click', '#cooalliance_uploadimage', function (e) {

        e.preventDefault();
        var $button = $(this);
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or Upload an Custom Avatar',
            library: {
                type: 'image' // mime type
            },
            button: {
                text: 'Select Avatar'
            },
            multiple: false
        });
        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            console.log(attachment.url);
            //	$button.siblings('#image').val( attachment.sizes.thumbnail.url );
            $button.siblings('#image').val( attachment.url );
            $button.siblings('.cooalliance_image_preview').attr( 'src', attachment.url );
        });
        file_frame.open();
    });
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
                    $('.status-success').fadeOut(1000);
                }, 1000);
            }
        });
    });
});
