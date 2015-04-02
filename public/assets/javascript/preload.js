(function ($) {

    // SpartaPark image resources
    var webImages = [];
    webImages.push('/assets/images/carousel-web-1.jpg');
    webImages.push('/assets/images/carousel-web-2.jpg');
    webImages.push('/assets/images/carousel-web-3.jpg');
    webImages.push('/assets/images/carousel-web-4.jpg');
    webImages.push('/assets/images/carousel-web-5.jpg');
    webImages.push('/assets/images/carousel-web-6.jpg');
    webImages.push('/assets/images/carousel-web-7.jpg');
    webImages.push('/assets/images/carousel-web-8.jpg');
    webImages.push('/assets/images/carousel-web-9.jpg');
    webImages.push('/assets/images/carousel-web-10.jpg');
    webImages.push('https://maps.googleapis.com/maps/api/staticmap?center=37.336,-121.881&zoom=15&size=347x339' +
        '&scale=1&maptype=roadmap&markers=color:red|label:|37.3353235,-121.8804712&markers=icon:http://spartapark' +
        '.cloudapp.net/assets/images/parking.png|37.3323731,-121.8830326&markers=icon:http://spartapark.cloudapp.net' +
        '/assets/images/parking.png|37.3331113,-121.8808485&markers=icon:http://spartapark.cloudapp.net/assets/' +
        'images/parking.png|37.339324,-121.880713');
    webImages.push('/assets/images/follow-us-facebook.png');
    webImages.push('/assets/images/follow-us-google-plus.png');
    webImages.push('/assets/images/follow-us-linkedin.png');
    webImages.push('/assets/images/follow-us-pinterest.png');
    webImages.push('/assets/images/follow-us-twitter.png');
    webImages.push('/assets/images/object-recognition-image.jpg');
    webImages.push('/assets/images/raspberry-pi-image.jpg');
    webImages.push('/assets/images/web-service-image.png');
    webImages.push('/assets/images/story-section-background.jpeg');
    webImages.push('/assets/images/back-to-top.png');
    webImages.push('/assets/images/back-to-top-hover.png');
    webImages.push('/assets/images/favicon.ico');
    webImages.push('/assets/images/SpartaParkFooterHead.png');
    webImages.push('/assets/images/SpartaParkFooterLogo.png');
    webImages.push('/assets/images/SpartaParkLogoWhite.png');
    webImages.push('/assets/images/header-image-contact.jpg');
    webImages.push('/assets/images/header-image-contact-1.jpg');
    webImages.push('/assets/images/header-image-contact-2.jpg');
    webImages.push('/assets/images/header-image-contact-3.jpg');
    webImages.push('/assets/images/me.png');
    webImages.push('/assets/images/carousel-mobile-1.jpg');
    webImages.push('/assets/images/carousel-mobile-2.jpg');
    webImages.push('/assets/images/carousel-mobile-3.jpg');
    webImages.push('/assets/images/carousel-mobile-4.jpg');
    webImages.push('/assets/images/carousel-mobile-5.jpg');
    webImages.push('/assets/images/carousel-mobile-6.jpg');
    webImages.push('/assets/images/carousel-mobile-7.jpg');
    webImages.push('/assets/images/carousel-mobile-8.jpg');
    webImages.push('/assets/images/carousel-mobile-9.jpg');
    webImages.push('/assets/images/carousel-mobile-10.jpg');
    webImages.push('/assets/images/home.png');
    webImages.push('/assets/images/loading.gif');
    webImages.push('/assets/images/maneuvers.png');
    webImages.push('/assets/images/parkandride.png');
    webImages.push('/assets/images/parking.png');
    webImages.push('/assets/images/parking-meter-export.png');
    webImages.push('/assets/images/parking_bicycle.png');
    webImages.push('/assets/images/parking_disabled.png');
    webImages.push('/assets/images/parkinggarage.png');
    webImages.push('/assets/images/parkinggarage3.png');
    webImages.push('/assets/images/design-section-background.jpg');
    webImages.push('/assets/images/icon-zoom.png');

    // Preload images
    jQuery.imgpreload(webImages,
    {
        each: function()
        {
            var status = $(this).data('loaded')?'success':'error';
            console.log(status);
        },
        all: function()
        {
            console.log('all loaded');
        }

    });

    window.onload = function() {

        setTimeout(function() {

            // Preload JS and CSS
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/vendor/jquery-1.11.0.min.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/vendor/jquery.browser.min.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/vendor/bootstrap.min.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/vendor/enscroll-0.6.1.min.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/plugins.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/main.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascript/vendor/modernizr-2.6.2-respond-1.1.0.min.js');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/stylesheets/bootstrap.min.css');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/stylesheets/bootstrap-theme.min.css');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/stylesheets/animate.css');
            xhr.send('');
            xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/stylesheets/main.css');
            xhr.send('');
        }, 0);
    };

}(jQuery));