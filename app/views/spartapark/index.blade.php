@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="story-section-wrapper" id="story-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title">
                <h1>
                    The Story
                    <span>
                        created by us
                    </span>
                </h1>
                <div class="title-bullet">
                    <span></span>
                </div>
            </div>
            <div class="row row-padding">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="problem-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-exclamation-triangle"></i>
                        <h3>Problem</h3>
                        <p>A short paragraph (two or three sentences) describing the problem.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="vision-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-eye"></i>
                        <h3>Vision</h3>
                        <p>A short paragraph (two or three sentences) describing our vision or the big picture.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" id="goal-subsection">
                    <div class="story-icon-box animated rotateInUpRight">
                        <i class="fa fa-flag-checkered"></i>
                        <h3>Goal</h3>
                        <p>A short paragraph (two or three sentences) describing our goal or the steps we needed to take.</p>
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title">
                <h1>
                    The Design
                    <span>
                        used to reach our goal
                    </span>
                </h1>
                <div class="title-bullet">
                    <span></span>
                </div>
            </div>
            <div class="row row-padding">
            </div>
        </div>
    </div>
    <div class="service-section-wrapper" id="service-section">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-title">
                    <h1>
                        The Service
                        <span>
                            that brings comfort to students
                        </span>
                    </h1>
                    <div class="title-bullet">
                        <span></span>
                    </div>
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
    <div class="follow-us-wrapper unselectable">
        <div class="container">
            <div class="follow-us-title-container">
                <div class="follow-us-title unselectable">
                    Follow us:
                </div>
            </div>
            <div class="follow-us-icon-container">
                <span class="follow-us-icon-wrapper">
                    <a href="https://www.facebook.com/SpartaPark.SJSU/">
                        <div class="follow-us-icon facebook">
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
        </script>
    @endif
@stop
