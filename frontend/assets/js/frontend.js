jQuery(function ($) {
        'use strict';
    $(document).ready( function(){
            $('#account_tab_content>li:gt(0)').hide();
            $('#account_sidebar_nav li:first').addClass('active');
            $('#cooalliance_account #account_sidebar_nav li').bind('click', function() {
                $('li.active').removeClass('active');
                $(this).addClass('active');
                var target = $('a', this).attr('href');
                $(target).slideDown(400).siblings().slideUp(300);
                return false;
            });
         
    });
    
});
    