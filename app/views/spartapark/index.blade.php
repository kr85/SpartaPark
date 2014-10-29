@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="container">
                <hr><h3 class="text-center">Our Story</h3><hr>
                <div class="row row-padding">
                </div>
            </div>
            <div class="container">
                <hr><h3 class="text-center">Our Design</h3><hr>
                <div class="row row-padding">
                </div>
            </div>
            <div class="container">
                <hr><h3 class="text-center">Our Service</h3><hr>
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
                <div class="row-padding"></div>
                <div class="row-padding"></div>
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
