@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="story-section-wrapper unselectable" id="story-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title" id="section-title-story">
                <h1>
                    <span id="bullet-left"></span>
                    Story
                    <span id="bullet-right"></span>
                </h1>
            </div>
            <div class="row row-padding">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="problem-subsection">
                    <div class="story-icon-box">
                        <i class="fa fa-exclamation-triangle"></i>
                        <h3>Problem</h3>
                        <p class="story-subsection-text">A short paragraph (or maybe long) describing the problem.
                           Pretty much looking for that length of stuff stuff stuff.
                           Stuff stuff stuff stuff stuff stuff stuff stuff stuff stuff.
                           And some more stuff stuff stuff stuff stuff stuff stuff stuff stuff.
                           And even more stuff stuff stuff stuff stuff stuff stuff stuff stuff.
                           And even if you wrote more stuff stuff stuff stuff if would be fine...
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="vision-subsection">
                    <div class="story-icon-box">
                        <i class="fa fa-eye"></i>
                        <h3>Vision</h3>
                        <p class="story-subsection-text" id="vision-subsection-p">A short paragraph (a few sentences) describing our vision or the big picture.
                           Around same length as previous one.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="goal-subsection">
                    <div class="story-icon-box">
                        <i class="fa fa-flag-checkered"></i>
                        <h3>Goal</h3>
                        <p class="story-subsection-text">A short paragraph (a few sentences) describing our goal or the steps we needed to take.
                           Around same length as the first one.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="solution-subsection">
                    <div class="story-icon-box">
                        <i class="fa fa-users"></i>
                        <h3>Solution</h3>
                        <p class="story-subsection-text">...And SpartaPark was born.</p>
                        <p class="story-subsection-text">Or something like that... whatever you guys think we should write here...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="design-section-wrapper unselectable" id="design-section">
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
                    <div class="thumbnail hide animated" id="raspberry-pi">
                        <div class="raspberry-pi-image img-thumbnail"></div>
                        <div class="caption">
                            <p class="design-subsection-title">
                                Raspberry Pi  Ultimate Starter Kit
                            </p>
                            <p class="design-subsection-text">
                                Here we should write something about the Raspberry Pi kit
                                and how cool it is, cheap, easy to use and stuff like that or whatever you want to write.
                            </p>
                        </div>
                        <div id="raspberry-pi-dim"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="thumbnail hide animated" id="object-recognition">
                        <div class="object-recognition-image img-thumbnail"></div>
                        <div class="caption">
                            <p class="design-subsection-title">
                                Object Recognition
                            </p>
                            <p class="design-subsection-text">
                                Here we should write something about the super fancy object recognition
                                algorithms that we use to distinguish cars from other objects and stuff like that.
                            </p>
                        </div>
                        <div id="object-recognition-dim"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="thumbnail hide animated" id="web-service">
                        <div class="web-service-image img-thumbnail"></div>
                        <div class="caption">
                            <p class="design-subsection-title">
                                Web & Mobile Service
                            </p>
                            <p class="design-subsection-text">
                                Here we should write something about our service... that it is super cool, browser
                                responsive and available to everyone or whatever you guys want.
                            </p>
                        </div>
                        <div id="web-service-dim"></div>
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
        <div class="container follow-us-container-center">
            <div class="follow-us-title-container">
                <div class="follow-us-title">
                    Follow us:
                </div>
            </div>
            <div class="follow-us-icon-container">
            <div class="follow-us-icon-wrapper-center">
                <div class="follow-us-icon-wrapper hide animated" id="facebook-icon-animation">
                    <a href="https://www.facebook.com/SpartaPark.SJSU/">
                        <div class="follow-us-icon facebook" id="facebook-follow-us">
                            <i class="fa fa-facebook-square fa-5-5x"></i>
                        </div>
                    </a>
                </div>
                <div class="follow-us-icon-wrapper hide animated" id="google-icon-animation">
                    <a href="https://plus.google.com/101953367211116361515/about/">
                        <div class="follow-us-icon google-plus">
                            <i class="fa fa-google-plus-square fa-5-5x"></i>
                        </div>
                    </a>
                </div>
                <div class="follow-us-icon-wrapper hide animated" id="linkedin-icon-animation">
                    <a href="https://www.linkedin.com/in/spartapark/">
                        <div class="follow-us-icon linkedin">
                            <i class="fa fa-linkedin-square fa-5-5x"></i>
                        </div>
                    </a>
                </div>
                <div class="follow-us-icon-wrapper hide animated" id="pinterest-icon-animation">
                    <a href="http://www.pinterest.com/spartapark/">
                        <div class="follow-us-icon pinterest">
                            <i class="fa fa-pinterest-square fa-5-5x"></i>
                        </div>
                    </a>
                </div>
                <div class="follow-us-icon-wrapper hide animated" id="twitter-icon-animation">
                    <a href="https://twitter.com/SpartaParkSJSU/">
                        <div class="follow-us-icon twitter">
                            <i class="fa fa-twitter-square fa-5-5x"></i>
                        </div>
                    </a>
                </div>
            </div>
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

                var windowHeight = $(window).height(),
                    windowWidth = $(window).width(),
                    visibleNavbar = 300,
                    offsetNavbar = 55,
                    mobileDeviceMaxWidth = 985,
                    mobileDeviceSideNavigationHidden = 585,
                    storySectionRowLength = 1200,
                    storySectionOffsetTop = $('#story-section').offset().top,
                    designSectionOffsetTop = $('#design-section').offset().top,
                    serviceSectionOffsetTop = $('#service-section').offset().top,
                    followUsSectionOffsetTop = $('#follow-us-section').offset().top;

                $('div.container.follow-us-container-center').centerElement();

                // Reset window height and width on resize
                $(window).resize(function () {

                    windowHeight = $(window).height(),
                    windowWidth = $(window).width(),
                    storySectionOffsetTop = $('#story-section').offset().top,
                    designSectionOffsetTop = $('#design-section').offset().top,
                    serviceSectionOffsetTop = $('#service-section').offset().top,
                    followUsSectionOffsetTop = $('#follow-us-section').offset().top;

                }).resize();

                // Sets navbar to transparent
                $('.navbar').css({
                  'background': 'transparent',
                  'border': 'transparent'
                });

                $('.navbar-default').css({
                  'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
                });

                // Set CSS rules on ready
                if (windowWidth < mobileDeviceSideNavigationHidden) {
                    $('#scene-navigation').addClass('hide');
                }

                if (windowWidth > storySectionRowLength) {

                    // Set CSS rules on ready
                    $('.story-section-wrapper').css('height', (windowHeight - offsetNavbar));
                    $('.design-section-wrapper').css('height', (windowHeight - offsetNavbar));
                    $('.service-section-wrapper').css('height', (windowHeight - offsetNavbar));
                    $('.follow-us-wrapper').css('height', (windowHeight - (offsetNavbar / 2) ));

                    // Reset styles
                    $('.story-subsection-text').css({
                        'padding': '0px'
                    });

                } else if (windowWidth <= storySectionRowLength && windowWidth >= mobileDeviceMaxWidth) {

                    $('.story-section-wrapper').css('height', 'auto');
                    $('.design-section-wrapper').css('height', 'auto');
                    $('.service-section-wrapper').css('height', 'auto');
                    $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                    // Reset styles
                    $('.story-subsection-text').css({
                        'padding': '0px'
                    });

                    $('.story-subsection-text').css({
                        'padding-left': '50px',
                        'padding-right': '50px'
                    });

                    $('.story-subsection-text#vision-subsection-p').css({
                        'padding-bottom': '130px'
                    });

                } else if (windowWidth < mobileDeviceMaxWidth) {

                    $('.story-section-wrapper').css('height', 'auto');
                    $('.design-section-wrapper').css('height', 'auto');
                    $('.service-section-wrapper').css('height', 'auto');
                    $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                    // Reset styles
                    $('.story-subsection-text#vision-subsection-p').css({
                        'padding-bottom': '0px'
                    });

                    $('.story-subsection-text').css({
                        'padding-left': '50px',
                        'padding-right': '50px',
                        'padding-bottom': '50px'
                    });

                }


                $(window).scroll(function() {

                    if ( ($(this).scrollTop() + windowHeight) > $('.footer-wrapper').offset().top ) {

                        // Add animation effects to side navigation
                        $('#scene-navigation').removeClass('bounceInLeft');
                        $('#scene-navigation').addClass('bounceOutLeft');

                    } else if ( $(this).scrollTop() > visibleNavbar ) {

                        // Sets navbar to black after scroll
                        $('.navbar').css({
                            'background': 'black',
                            'border': 'black',
                            'box-shadow': '2px 2px 2px black'
                        });

                        // Add animation effects to side navigation
                        $('#scene-navigation').removeClass('hide');
                        $('#scene-navigation').removeClass('bounceOutLeft');
                        $('#scene-navigation').addClass('bounceInLeft');

                        //if (width < mobileDeviceSideNavigationHidden) {
                            //$('#scene-navigation').css('display', 'none');
                        //} else {
                            //$('#scene-navigation').css('display', 'block');
                        //}

                        //$('#scene-navigation').css('display', 'block');

                    } else {

                        // Sets navbar to transparent
                        $('.navbar').css({
                            'background': 'transparent',
                            'border': 'transparent',
                            'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
                        });

                        // Add animation effects to side navigation
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
                        scrollTop: ($('#follow-us-section').offset().top - (offsetNavbar - 5 ))
                    }, "slow");
                    return false;
                });

                // On window scroll add active class to scene navigator
                $(window).scroll(function() {

                    if ( $(window).scrollTop() > ($('#story-section').offset().top - (2 * offsetNavbar))
                        && $(window).scrollTop() < ($('#design-section').offset().top - offsetNavbar) ) {

                        $('#scene-navigator-design').removeClass('active');
                        $('#scene-navigator-service').removeClass('active');
                        $('#scene-navigator-follow-us').removeClass('active');
                        $('#scene-navigator-story').addClass('active');

                        $('#problem-subsection').removeClass('hide');
                        $('#vision-subsection').removeClass('hide');
                        $('#goal-subsection').removeClass('hide');
                        $('#solution-subsection').removeClass('hide');

                        $('#problem-subsection').addClass('fadeInLeft');
                        $('#vision-subsection').addClass('fadeInDown');
                        $('#goal-subsection').addClass('fadeInUp');
                        $('#solution-subsection').addClass('fadeInRight');

                    } else if ( $(window).scrollTop() > ($('#design-section').offset().top - (2 * offsetNavbar))
                        && $(window).scrollTop() < ($('#service-section').offset().top - offsetNavbar) ) {

                        $('#scene-navigator-story').removeClass('active');
                        $('#scene-navigator-service').removeClass('active');
                        $('#scene-navigator-follow-us').removeClass('active');
                        $('#scene-navigator-design').addClass('active');

                        $('#raspberry-pi').removeClass('hide');
                        $('#object-recognition').removeClass('hide');
                        $('#web-service').removeClass('hide');

                        $('#raspberry-pi').addClass('bounceInLeft');
                        $('#object-recognition').addClass('rotateIn');
                        $('#web-service').addClass('bounceInRight');
;

                    } else if ( $(window).scrollTop() > ($('#service-section').offset().top - (2 * offsetNavbar))
                        && $(window).scrollTop() < ($('#follow-us-section').offset().top - offsetNavbar) ) {

                        $('#scene-navigator-story').removeClass('active');
                        $('#scene-navigator-design').removeClass('active');
                        $('#scene-navigator-follow-us').removeClass('active');
                        $('#scene-navigator-service').addClass('active');

                    } else if ( $(window).scrollTop() > ($('#follow-us-section').offset().top - (2 * offsetNavbar)) ) {

                        $('#scene-navigator-story').removeClass('active');
                        $('#scene-navigator-design').removeClass('active');
                        $('#scene-navigator-service').removeClass('active');
                        $('#scene-navigator-follow-us').addClass('active');

                        $('#facebook-icon-animation').removeClass('hide');
                        $('#google-icon-animation').removeClass('hide');
                        $('#linkedin-icon-animation').removeClass('hide');
                        $('#pinterest-icon-animation').removeClass('hide');
                        $('#twitter-icon-animation').removeClass('hide');

                        $('#facebook-icon-animation').addClass('bounceInLeft');
                        $('#google-icon-animation').addClass('fadeInDownBig');
                        $('#linkedin-icon-animation').addClass('zoomIn');
                        $('#pinterest-icon-animation').addClass('fadeInUpBig');
                        $('#twitter-icon-animation').addClass('bounceInRight');
                    }

                });

                // Change the height of the main page's sectio wrappers on resize
                $(window).resize(function () {

                    var height = $(window).height(),
                        width = $(window).width();


                    if (width > storySectionRowLength) {

                        // Set CSS rules on ready
                        $('.story-section-wrapper').css('height', (height - offsetNavbar));
                        $('.design-section-wrapper').css('height', (height - offsetNavbar));
                        $('.service-section-wrapper').css('height', (height - offsetNavbar));
                        $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                        // Reset styles
                        $('.story-subsection-text').css({
                            'padding': '0px'
                        });

                    } else if (width <= storySectionRowLength && width >= mobileDeviceMaxWidth) {

                        $('.story-section-wrapper').css('height', 'auto');
                        $('.design-section-wrapper').css('height', (height - offsetNavbar));
                        $('.service-section-wrapper').css('height', (height - offsetNavbar));
                        $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                        // Reset padding
                        $('.story-subsection-text').css({
                            'padding': '0px'
                        });

                        $('.story-subsection-textg').css({
                            'padding-left': '50px',
                            'padding-right': '50px'
                        });

                        $('.story-subsection-text#vision-subsection-p').css({
                            'padding-bottom': '130px'
                        });

                    } else if (width < mobileDeviceMaxWidth) {

                        $('.story-section-wrapper').css('height', 'auto');
                        $('.design-section-wrapper').css('height', 'auto');
                        $('.service-section-wrapper').css('height', 'auto');
                        $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                        // Reset styles
                        $('.story-subsection-text#vision-subsection-p').css({
                            'padding-bottom': '0px'
                        });

                        $('.story-subsection-text').css({
                            'padding-left': '50px',
                            'padding-right': '50px',
                            'padding-bottom': '50px'
                        });

                    }

                }).resize();

                $('#raspberry-pi')
                    .mouseenter(function() {
                        $('#object-recognition-dim').addClass('dim');
                        $('#web-service-dim').addClass('dim');
                    })
                    .mouseleave(function() {
                        $('#object-recognition-dim').removeClass('dim');
                        $('#web-service-dim').removeClass('dim');
                });

                $('#object-recognition')
                    .mouseenter(function() {
                        $('#raspberry-pi-dim').addClass('dim');
                        $('#web-service-dim').addClass('dim');
                    })
                    .mouseleave(function() {
                        $('#raspberry-pi-dim').removeClass('dim');
                        $('#web-service-dim').removeClass('dim');
                });

                $('#web-service')
                    .mouseenter(function() {
                        $('#raspberry-pi-dim').addClass('dim');
                        $('#object-recognition-dim').addClass('dim');
                    })
                    .mouseleave(function() {
                        $('#raspberry-pi-dim').removeClass('dim');
                        $('#object-recognition-dim').removeClass('dim');
                });

            });
        </script>
    @endif
@stop
