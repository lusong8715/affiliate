;(function($){
    $(document).ready(function () {
        $(document).on('click', '.open_view', function(){
            var link = $(this).find('td:last a').attr('href');
            window.location.href = link;
        });

        $(document).on('click', '#update_data', function(){
            var start = '';
            if ($('#date_start').length > 0) {
                start = $('#date_start').val();
            }
            var end = '';
            if ($('#date_end').length > 0) {
                end = $('#date_end').val();
            }
            var action = window.location.pathname;
            action = action.substring(1);
            $('.loading').show();
            $.ajax({
                url: '/sync',
                type: 'post',
                dataType: 'json',
                data: {
                    start: start,
                    end: end,
                    action: action
                },
                success: function (json) {
                    window.location.reload();
                },
                error: function (meg) {
                    $('.loading').hide();
                    alert(meg);
                }
            });
        });
    });
})(jQuery);