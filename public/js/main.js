;(function($){
    $(document).ready(function () {
        $(document).on('click', '.open_view', function(){
            var link = $(this).find('td:last a').attr('href');
            window.location.href = link;
        });
    });
})(jQuery);