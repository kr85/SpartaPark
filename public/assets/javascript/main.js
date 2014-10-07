(function ($) {
    // Smooth scrolling
    $(function() {
        $("a[href='#top']").on('click', function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });
    });
}(jQuery));