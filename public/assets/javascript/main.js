(function ($) {

    // Show loading gif on page load
    $(window).load(function() {
        $('.loader').fadeOut('slow');
    });

    // Smooth scrolling
    $(function() {

        // For back to top
        $("a[href='#top']").on('click', function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });
    });

    /*$(window).scroll(function() {
        var offsetStorySection = $('#story-section').offset().top - 100;
        var topWindow = $(window).scrollTop() - (offsetStorySection / 2);
        var halfWindow = topWindow *  1.5;

        var windowHeight = $(window).height();

        var position = halfWindow / windowHeight;
        position = 1 - position;

        //console.log('First -- Offset: ' + offsetStorySection + ', topWindow: ' + topWindow + ', halfWindow: ' + halfWindow + ', windowHeight: ' + windowHeight + ', position: ' + position);

        $('.scroll-arrow-wrapper-design-section').css('opacity', position);
    });

    $(window).scroll(function() {
        var offsetDesignSection = $('#design-section').offset().top;
        var topWindow = $(window).scrollTop() - (offsetDesignSection / 2);
        var halfWindow = topWindow *  1.5;
        var windowHeight = $(window).height();
        var position = halfWindow / windowHeight;
        position = 1 - position;

        console.log('Second -- Offset: ' + offsetDesignSection + ', topWindow: ' + topWindow + ', halfWindow: ' + halfWindow + ', windowHeight: ' + windowHeight + ', position: ' + position);

        $('.scroll-arrow-wrapper-service-section').css('opacity', position);
    });*/

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