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

    // Chrome CSS fixes
    $(function() {
        $.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());

        if ($.browser.chrome) {

            $('div.content-wrapper, div#googleMap.map-canvas').css({
                'min-height': '800px'
            });

            $('footer.footer-wrapper').css({
                'width': '100%',
                'bottom': '0',
                'position': 'relative',
                'margin': '0px auto'
            });

            $('footer.footer-wrapper ul').css({
                'margin-top': '25px'
            });

            $('li.vertical-align-back-to-top').css({
                'margin-top': '-25px'
            });
        }
    });
}(jQuery));