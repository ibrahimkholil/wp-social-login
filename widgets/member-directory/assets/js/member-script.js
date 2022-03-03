(function ($) {
    'use-strict';
    $(document).ready(function () {
        $('#MemberSearchForm').on('submit', function (e) {
            e.preventDefault();

            var searchTerm = $('#search-term').val();
            // alert(searchTerm);
            $.ajax({
                method: 'POST',
                url: member_search_obj.ajax_url,
                // url: '/wp-admin/admin-ajax.php',
                // dataType: 'json',
                beforeSend: function (xhr) {
                    $('.cooalliance-loader').fadeIn(200);
                },
                data: {
                    action: 'member_search_filter',
                    search_term: searchTerm,
                    security: member_search_obj.nonce,
                },
                success: function (r) {
                    console.log(r);
                    $('#search-filter-data').html(r);
                    $('.cooalliance-loader').fadeOut(200);
                },
                error: function (r) {
                    console.error(r);
                }
            });

        });
    });


})(jQuery);
