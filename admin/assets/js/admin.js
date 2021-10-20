jQuery(function ($) {
    'use strict';
    $(document).ready( function(){
      // user profile admin
      // $(document).find("input[id^='uploadimage']").on('click', function(e){
      //     //var num = this.id.split('-')[1];
      //
      //     let formfield = '';
      //     formfield = $('#image').attr('name');
      //     tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
      //
      //     window.send_to_editor = function(html) {
      //     console.log(html);
      //         imgurl = $('img',html).attr('src');
      //         $('#image').val(imgurl);
      //
      //         tb_remove();
      //     }
      //
      //     return false;
      // });
      //
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
    });

});
