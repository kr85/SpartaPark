@extends('layouts.master')

@section('script')

@stop

@section('content')
    <div class="container">
        <div class="content-wrapper">
            <h3>Content Here Soon...</h3>
            <div class="row">
                <div class="col-md-6 col-lg-5">
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="index-map-canvas">
                        <a href="/parking">
                            <div class="static-map"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <h3>Some other content here...</h3>
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
