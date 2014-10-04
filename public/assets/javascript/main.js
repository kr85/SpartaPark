(function ($) {
    // Navbar effect
    $(document).ready(function() {
       // Sets navbar to transparent
       $(function() {
          $('.navbar').css({
              'background': 'transparent',
              'border': 'transparent'
          });
          $('.navbar-default').css({
              'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
          });

          $(window).scroll(function() {
              // Sets navbar to black after scroll
              if ($(this).scrollTop() > 150) {
                  $('.navbar').css({
                      'background': 'black',
                      'border': 'black',
                      'box-shadow': '2px 2px 2px black'
                  });
              } else {
                  // Sets navbar to transparent
                  $('.navbar').css({
                      'background': 'transparent',
                      'border': 'transparent',
                      'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
                  });
              }
          });
       });
    });

    // Back to top smooth scroll
    $(document).ready(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
                || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
}(jQuery));