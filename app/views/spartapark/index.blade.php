@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="story-section-wrapper" id="story-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title" id="section-title-story">
                <h1>
                    <span id="bullet-left"></span>
                    Story
                    <span id="bullet-right"></span>
                </h1>
            </div>
            <div class="row row-padding">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="problem-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-exclamation-triangle"></i>
                        <h3>Problem</h3>
                        <p>A short paragraph (a few sentences) describing the problem.
                           Pretty much looking for that length of stuff stuff stuff.
                           Stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff.
                           And some more stuff stuff stuff stuff stuff stuff stuff stuff stuff.
                           And even more stuff stuff stuff stuff stuff stuff stuff stuff stuff.
                           And even if you wrote more stuff stuff stuff stuff if would be fine...
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="vision-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-eye"></i>
                        <h3>Vision</h3>
                        <p>A short paragraph (a few sentences) describing our vision or the big picture.
                           Around same length as previous one.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="goal-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-flag-checkered"></i>
                        <h3>Goal</h3>
                        <p>A short paragraph (a few sentences) describing our goal or the steps we needed to take.
                           Around same length as the first one.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="solution-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-users"></i>
                        <h3>Solution</h3>
                        <p>...And SpartaPark was born.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="design-section-wrapper" id="design-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title" id="section-title-design">
                <h1>
                    <span id="bullet-left"></span>
                    Design
                    <span id="bullet-right"></span>
                </h1>
            </div>
            <div class="row row-padding">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="thumbnail" id="raspberry-pi">
                        <div class="raspberry-pi-image img-thumbnail"></div>
                        <div class="caption">
                            <p>Raspberry Pi Ultimate Starter Kit</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="thumbnail" id="object-recognition">
                        <div class="object-recognition-image img-thumbnail"></div>
                        <div class="caption">
                            <p>Object Recognition</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="thumbnail" id="web-service">
                        <div class="web-service-image img-thumbnail"></div>
                        <div class="caption">
                            <p>Web & Mobile Service</p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="service-section-wrapper" id="service-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title" id="section-title-service">
                    <h1>
                        <span id="bullet-left"></span>
                        Service
                        <span id="bullet-right"></span>
                    </h1>
            </div>
            <div class="row row-padding">
                <div class="col-md-8 col-lg-8">
                    <ul>
                        <li>Stuff</li>
                        <li>Stuff</li>
                        <li>Stuff</li>
                        <li>Stuff</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="index-map-canvas">
                        <a href="/parking">
                            <div class="static-map"></div>
                            <div class="view-full-map-container">
                                <div class="view-full-map">
                                    <span>View Map</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="follow-us-wrapper unselectable" id="follow-us-section">
        <div class="container">
            <div class="follow-us-title-container">
                <div class="follow-us-title unselectable">
                    Follow us:
                </div>
            </div>
            <div class="follow-us-icon-container">
                <span class="follow-us-icon-wrapper">
                    <a href="https://www.facebook.com/SpartaPark.SJSU/">
                        <div class="follow-us-icon facebook" id="facebook-follow-us">
                            <i class="fa fa-facebook-square fa-5-5x"></i>
                        </div>
                    </a>
                </span>
                <span class="follow-us-icon-wrapper">
                    <a href="https://plus.google.com/101953367211116361515/about/">
                        <div class="follow-us-icon google-plus">
                            <i class="fa fa-google-plus-square fa-5-5x"></i>
                        </div>
                    </a>
                </span>
                <span class="follow-us-icon-wrapper">
                    <a href="https://www.linkedin.com/in/spartapark/">
                        <div class="follow-us-icon linkedin">
                            <i class="fa fa-linkedin-square fa-5-5x"></i>
                        </div>
                    </a>
                </span>
                <span class="follow-us-icon-wrapper">
                    <a href="http://www.pinterest.com/spartapark/">
                        <div class="follow-us-icon pinterest">
                            <i class="fa fa-pinterest-square fa-5-5x"></i>
                        </div>
                    </a>
                </span>
                <span class="follow-us-icon-wrapper">
                    <a href="https://twitter.com/SpartaParkSJSU/">
                        <div class="follow-us-icon twitter">
                            <i class="fa fa-twitter-square fa-5-5x"></i>
                        </div>
                    </a>
                </span>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')
    <!-- Preloader script -->
    {{ HTML::script('assets/javascript/preload.js') }}

    @if(Route::currentRouteName() == 'index')
        <script>

            $(function() {

                var offsetNavbar = 55;

                // Sets navbar to transparent
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

                        $('#scene-navigation').removeClass('hide');
                        $('#scene-navigation').removeClass('bounceOutLeft');
                        $('#scene-navigation').addClass('bounceInLeft');

                    } else {
                        // Sets navbar to transparent
                        $('.navbar').css({
                            'background': 'transparent',
                            'border': 'transparent',
                            'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
                        });

                        $('#scene-navigation').removeClass('bounceInLeft');
                        $('#scene-navigation').addClass('bounceOutLeft');

                    }
                });

                // Smooth scrolling for go to story section
                $("a[href='#story-section']").on('click', function() {
                    $("html, body").animate({
                        scrollTop: ($('#story-section').offset().top - offsetNavbar)
                    }, "slow");
                    return false;
                });

                // Smooth scrolling for go to design section
                $("a[href='#design-section']").on('click', function() {
                    $("html, body").animate({
                        scrollTop: ($('#design-section').offset().top - offsetNavbar)
                    }, "slow");
                    return false;
                });

                // Smooth scrolling for go to service section
                $("a[href='#service-section']").on('click', function() {
                    $("html, body").animate({
                        scrollTop: ($('#service-section').offset().top - offsetNavbar)
                    }, "slow");
                    return false;
                });

                // Smooth scrolling for go to service section
                $("a[href='#follow-us-section']").on('click', function() {
                    $("html, body").animate({
                        scrollTop: ($('#follow-us-section').offset().top - offsetNavbar)
                    }, "slow");
                    return false;
                });

                // On window scroll add active class to scene navigator
                $(window).scroll(function() {

                    if ( $(window).scrollTop() > ($('#story-section').offset().top - (2 * offsetNavbar)) && $(window).scrollTop() < ($('#design-section').offset().top - offsetNavbar) ) {

                        $('#scene-navigator-design').removeClass('active');
                        $('#scene-navigator-service').removeClass('active');
                        $('#scene-navigator-follow-us').removeClass('active');
                        $('#scene-navigator-story').addClass('active');

                    }

                    if ( $(window).scrollTop() > ($('#design-section').offset().top - (2 * offsetNavbar))  && $(window).scrollTop() < ($('#service-section').offset().top - offsetNavbar) ) {

                        $('#scene-navigator-story').removeClass('active');
                        $('#scene-navigator-service').removeClass('active');
                        $('#scene-navigator-follow-us').removeClass('active');
                        $('#scene-navigator-design').addClass('active');
                    }

                    if ( $(window).scrollTop() > ($('#service-section').offset().top - (2 * offsetNavbar)) && $(window).scrollTop() < ($('#follow-us-section').offset().top - offsetNavbar) ) {

                        $('#scene-navigator-story').removeClass('active');
                        $('#scene-navigator-design').removeClass('active');
                        $('#scene-navigator-follow-us').removeClass('active');
                        $('#scene-navigator-service').addClass('active');

                    }

                    if ( $(window).scrollTop() > ($('#follow-us-section').offset().top - (2 * offsetNavbar)) ) {

                        $('#scene-navigator-story').removeClass('active');
                        $('#scene-navigator-design').removeClass('active');
                        $('#scene-navigator-service').removeClass('active');
                        $('#scene-navigator-follow-us').addClass('active');
                    }
                });


                //$('#facebook-follow-us')
                //  .mouseenter(function() {
                    //$('#facebook-follow-us').removeClass('animated fadeOut');
                    //$('#facebook-follow-us').addClass('animated fadeIn');
                //  })
                //  .mouseleave(function() {
                    //$('#facebook-follow-us').removeClass('animated fadeIn');
                    //$('#facebook-follow-us').addClass('animated fadeOut');
                //  });
            });
        </script>
    @endif
@stop
