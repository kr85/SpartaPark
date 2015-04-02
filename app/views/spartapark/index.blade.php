@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="story-section-wrapper unselectable" id="story-section">
        <div class="container">
            <div class="z-index-1000 col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title" id="section-title-story">
                <h1 class="title-underline">
                    <span id="bullet-left-story"></span>
                    Story
                    <span id="bullet-right-story"></span>
                </h1>
            </div>
            <div class="row row-padding">
                <div class="z-index-1000 col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="problem-subsection">
                    <div class="story-icon-box animated" id="story-icon-box-problem">
                        <i class="fa fa-exclamation-triangle"></i>
                        <h3>Problem</h3>
                        <p class="story-subsection-text">
                        Parking at San Jose State is an incredibly frustrating experience. Because of the regular
                        schedule of classes, the parking garages have incredibly busy periods where a large number of
                        people are all competing to find the last spot at once. Students and faculty often spend as
                        much time trying to park as they do driving to campus, wasting gas, time, and patience.
                        </p>
                    </div>
                </div>
                <div class="z-index-1000 col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="vision-subsection">
                    <div class="story-icon-box animated" id="story-icon-box-vision">
                        <i class="fa fa-eye"></i>
                        <h3>Vision</h3>
                        <p class="story-subsection-text" id="vision-subsection-p">
                        We believe that parking can be made better even without expanding parking lot capacity.
                        We aimed to make it possible to not have to ever spend time looking for a parking spot again.
                        </p>
                    </div>
                </div>
                <div class="z-index-1000 col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="goal-subsection">
                    <div class="story-icon-box animated" id="story-icon-box-goal">
                        <i class="fa fa-flag-checkered"></i>
                        <h3>Goal</h3>
                        <p class="story-subsection-text">
                        A significant part of the problem is people not knowing what garages have spaces available,
                        and where in the garage they are. Our goal was to make information about capacity and
                        availability location available to everybody, anywhere.
                        </p>
                    </div>
                </div>
                <div class="z-index-1000 col-xs-12 col-sm-12 col-md-6 col-lg-3 hide animated" id="solution-subsection">
                    <div class="story-icon-box animated" id="story-icon-box-solution">
                        <i class="fa fa-users"></i>
                        <h3>Solution</h3>
                        <p class="story-subsection-text">
                        We created the SpartaPark system, which can be installed in any parking garage or lot.
                        A small number of sensors all provide information to a central service that informs users of
                        the exact number of spaces available on each floor of each garage. This information is
                        available on the web or on your phone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim-white"></div>
    </div>
    <div class="design-section-wrapper unselectable" id="design-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title" id="section-title-design">
                <h1 class="title-underline">
                    <span id="bullet-left-design"></span>
                    Design
                    <span id="bullet-right-design"></span>
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
                                The physical hardware we used is a Raspberry Pi, a low cost computer that can serve
                                as a simple hardware base for many purposes. We used a camera and motion sensor module
                                to take photos whenever there is movement in front of our sensors.
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
                                Object Recognition Software
                            </p>
                            <p class="design-subsection-text">
                                Motion detection alone would not provide an accurate count of cars in a garage, as
                                people or animals could also set off the motion detector. We therefore analyze the
                                photos to determine if they are actually cars.
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
                                All of the information provided by our sensors gets uploaded to our web service, so
                                that we can then provide useful features to users on their phone or the web. They can
                                search for parking garages by location or name, view availabilities, and remove the
                                stress from the parking experience.
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
                    <h1 class="title-underline">
                        <span id="bullet-left-service"></span>
                        Service
                        <span id="bullet-right-service"></span>
                    </h1>
            </div>
            <div class="row row-padding">
                <div class="col-md-8 col-lg-8 hide animated" id="service-section-text">
                    <p class="service-subsection-title">Try it for yourself</p>
                    <ul class="service-subsection-text">
                        <li>View the map</li>
                        <li>Check the available parking spaces</li>
                        <li>Get the directions and commute to the parking lot</li>
                        <li>Avoid the usual stress and frustration of finding parking</li>
                        <li>Enjoy your classes</li>
                    </ul>
                </div>
                <div class="col-md-4 hide animated" id="service-section-map">
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

                var visibleNavbar = 300,
                    offsetNavbar = 55,
                    offsetFooter = 265,
                    mobileDeviceMaxWidth = 990,
                    mobileDeviceSideNavigationHidden = 585,
                    storySectionRowLength = 1200;

                // Center follow us container
                $('div.container.follow-us-container-center').centerElement();

                // Sets navbar to transparent
                $('.navbar').css({
                  'background': 'transparent',
                  'border': 'transparent'
                });

                $('.navbar-default').css({
                  'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
                });

                // Hide scene navigation if browser size is mobile
                if ($(window).width() < mobileDeviceSideNavigationHidden) {
                    $('.scene-navigation').css('display', 'none');
                }

                if ($(window).width() > storySectionRowLength) {

                    // Set CSS rules on ready
                    $('.story-section-wrapper').css('height', ($(window).height() - offsetNavbar));
                    $('.design-section-wrapper').css('height', ($(window).height() - offsetNavbar));
                    $('.service-section-wrapper').css('height', ($(window).height() - offsetNavbar));
                    $('.follow-us-wrapper').css('height', ($(window).height() - (offsetNavbar / 2) ));

                } else if ($(window).width() <= storySectionRowLength && $(window).width() >= mobileDeviceMaxWidth) {

                    $('.story-section-wrapper').css('height', 'auto');
                    $('.design-section-wrapper').css('height', 'auto');
                    $('.service-section-wrapper').css('height', 'auto');
                    $('.follow-us-wrapper').css('height', ($(window).height() - (offsetNavbar / 2)));

                } else if ($(window).width() < mobileDeviceMaxWidth) {

                    $('.story-section-wrapper').css('height', 'auto');
                    $('.design-section-wrapper').css('height', 'auto');
                    $('.service-section-wrapper').css('height', 'auto');
                    $('.follow-us-wrapper').css('height', ($(window).height() - (offsetNavbar / 2)));

                }

                $(window).scroll(function() {

                    if (($(this).scrollTop() + $(window).height()) > ($('.footer-wrapper').offset().top + (offsetFooter / 2))) {

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
                        && $(window).scrollTop() < ($('#design-section').offset().top - (2 * offsetNavbar)) ) {

                        setActiveSceneNavigator(
                            '#scene-navigator-design',
                            '#scene-navigator-service',
                            '#scene-navigator-follow-us',
                            '#scene-navigator-story'
                        );

                        $('#problem-subsection').removeClass('hide');
                        $('#vision-subsection').removeClass('hide');
                        $('#goal-subsection').removeClass('hide');
                        $('#solution-subsection').removeClass('hide');

                        $('#problem-subsection').addClass('fadeInLeft');
                        $('#vision-subsection').addClass('fadeInDown');
                        $('#goal-subsection').addClass('fadeInUp');
                        $('#solution-subsection').addClass('fadeInRight');

                    } else if ( $(window).scrollTop() >= ($('#design-section').offset().top - (2 * offsetNavbar))
                        && $(window).scrollTop() < ($('#service-section').offset().top - (2 * offsetNavbar)) ) {

                        setActiveSceneNavigator(
                            '#scene-navigator-story',
                            '#scene-navigator-service',
                            '#scene-navigator-follow-us',
                            '#scene-navigator-design'
                        );

                        $('#raspberry-pi').removeClass('hide');
                        $('#object-recognition').removeClass('hide');
                        $('#web-service').removeClass('hide');

                        $('#raspberry-pi').addClass('bounceInLeft');
                        $('#object-recognition').addClass('rotateIn');
                        $('#web-service').addClass('bounceInRight');


                    } else if ( $(window).scrollTop() >= ($('#service-section').offset().top - (2 * offsetNavbar))
                        && $(window).scrollTop() < ($('#follow-us-section').offset().top - (2 * offsetNavbar)) ) {

                        setActiveSceneNavigator(
                            '#scene-navigator-story',
                            '#scene-navigator-design',
                            '#scene-navigator-follow-us',
                            '#scene-navigator-service'
                        );

                        $('#service-section-text').removeClass('hide');
                        $('#service-section-map').removeClass('hide');

                        $('#service-section-text').addClass('rotateInUpLeft');
                        $('#service-section-map').addClass('bounceInRight');

                    } else if ( $(window).scrollTop() >= ($('#follow-us-section').offset().top - (2 * offsetNavbar)) ) {

                        setActiveSceneNavigator(
                            '#scene-navigator-story',
                            '#scene-navigator-design',
                            '#scene-navigator-service',
                            '#scene-navigator-follow-us'
                        );

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

                    } else if (width <= storySectionRowLength && width >= mobileDeviceMaxWidth) {

                        $('.story-section-wrapper').css('height', 'auto');
                        $('.design-section-wrapper').css('height', (height - offsetNavbar));
                        $('.service-section-wrapper').css('height', (height - offsetNavbar));
                        $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                    } else if (width < mobileDeviceMaxWidth) {

                        $('.story-section-wrapper').css('height', 'auto');
                        $('.design-section-wrapper').css('height', 'auto');
                        $('.service-section-wrapper').css('height', 'auto');
                        $('.follow-us-wrapper').css('height', (height - (offsetNavbar / 2)));

                    }

                }).resize();

                if ($(window).width() > mobileDeviceMaxWidth ) {
                    setEffectElements();
                }

                function setActiveSceneNavigator(notActiveOne, notActiveTwo, notActiveThree, active)
                {
                        var $notActiveOne = $(notActiveOne),
                            $notActiveTwo = $(notActiveTwo),
                            $notActiveThree = $(notActiveThree),
                            $active = $(active);

                        $notActiveOne.removeClass('active');
                        $notActiveTwo.removeClass('active');
                        $notActiveThree.removeClass('active');
                        $active.addClass('active');
                }

                function setEffectElements()
                {
                    // Add flip effect to story section elements
                    $('#problem-subsection').setFlipElements(
                        '#story-icon-box-vision',
                        '#story-icon-box-goal',
                        '#story-icon-box-solution'
                    );

                    $('#vision-subsection').setFlipElements(
                        '#story-icon-box-problem',
                        '#story-icon-box-goal',
                        '#story-icon-box-solution'
                    );

                    $('#goal-subsection').setFlipElements(
                        '#story-icon-box-problem',
                        '#story-icon-box-vision',
                        '#story-icon-box-solution'
                    );

                    $('#solution-subsection').setFlipElements(
                        '#story-icon-box-problem',
                        '#story-icon-box-vision',
                        '#story-icon-box-goal'
                    );

                    // Add dim effect to design section elements
                    $('#raspberry-pi').setDimElements(
                        '#object-recognition-dim',
                        '#web-service-dim'
                    );

                    $('#object-recognition').setDimElements(
                        '#raspberry-pi-dim',
                        '#web-service-dim'
                    )

                    $('#web-service').setDimElements(
                        '#raspberry-pi-dim',
                        '#object-recognition-dim'
                    )
                }

            });
        </script>
    @endif
@stop