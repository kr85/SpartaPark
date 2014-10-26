(function ($) {

    // Show loading gif on page load
    $(window).load(function() {
        $('.loader').fadeOut('slow');
    });

    // Smooth scrolling
    $(function() {
        $("a[href='#top']").on('click', function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });
    });

    // Chrome CSS fixes
    $(function() {
        $.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());

        if ($.browser.chrome) {

            $('footer.footer-wrapper ul').css({
                'margin-top': '25px'
            });

            $('li.vertical-align-back-to-top').css({
                'margin-top': '-25px'
            });
        }
    });
}(jQuery));