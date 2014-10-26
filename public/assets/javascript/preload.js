(function ($) {
    window.onload = function() {
        setTimeout(function() {

            // Preload images
            new Image().src = '/assets/images/carousel-web-1.jpg';
            new Image().src = '/assets/images/carousel-web-2.jpg';
            new Image().src = '/assets/images/carousel-web-3.jpg';
            new Image().src = '/assets/images/carousel-web-4.jpg';
            new Image().src = '/assets/images/carousel-web-5.jpg';
            new Image().src = '/assets/images/carousel-web-6.jpg';
            new Image().src = '/assets/images/carousel-web-7.jpg';
            new Image().src = '/assets/images/carousel-web-8.jpg';
            new Image().src = '/assets/images/carousel-web-9.jpg';
            new Image().src = '/assets/images/carousel-web-10.jpg';
            new Image().src = '/assets/images/backTopOff.png';
            new Image().src = '/assets/images/top.png';
            new Image().src = '/assets/images/favicon.ico';
            new Image().src = '/assets/images/SpartaParkFooterHead.png';
            new Image().src = '/assets/images/SpartaParkFooterLogo.png';
            new Image().src = '/assets/images/SpartaParkLogoWhite.png';
            new Image().src = '/assets/images/header-image-contact.jpg';
            new Image().src = '/assets/images/header-image-contact-1.jpg';
            new Image().src = '/assets/images/header-image-contact-2.jpg';
            new Image().src = '/assets/images/header-image-contact-3.jpg';
            new Image().src = '/assets/images/me.png';
            new Image().src = '/assets/images/carousel-mobile-1.jpg';
            new Image().src = '/assets/images/carousel-mobile-2.jpg';
            new Image().src = '/assets/images/carousel-mobile-3.jpg';
            new Image().src = '/assets/images/carousel-mobile-4.jpg';
            new Image().src = '/assets/images/carousel-mobile-5.jpg';
            new Image().src = '/assets/images/carousel-mobile-6.jpg';
            new Image().src = '/assets/images/carousel-mobile-7.jpg';
            new Image().src = '/assets/images/carousel-mobile-8.jpg';
            new Image().src = '/assets/images/carousel-mobile-9.jpg';
            new Image().src = '/assets/images/carousel-mobile-10.jpg';
            new Image().src = '/assets/images/home.png';
            new Image().src = '/assets/images/loading.gif';
            new Image().src = '/assets/images/maneuvers.png';
            new Image().src = '/assets/images/parkandride.png';
            new Image().src = '/assets/images/parking.png';
            new Image().src = '/assets/images/parking-meter-export.png';
            new Image().src = '/assets/images/parking_bicycle.png';
            new Image().src = '/assets/images/parking_disabled.png';
            new Image().src = '/assets/images/parkinggarage.png';
            new Image().src = '/assets/images/parkinggarage3.png';

            // Preload JS and CSS
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/assets/javascrpt/vendor/jquery-1.10.2.min.js');
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
            xhr.open('GET', '/assets/stylesheets/main.css');
            xhr.send('');
        }, 1000);
    };

}(jQuery));