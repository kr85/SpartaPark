@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="container">
                <hr><h3 class="text-center">Some title here</h3><hr>
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
            <div class="container">
                <hr><h3 class="text-center">Some other stuff here</h3><hr>
                <div class="row row-padding">
                </div>
            </div>
            <div class="follow-us-wrapper">
                <div class="container">
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
