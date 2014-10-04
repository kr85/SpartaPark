@extends('layouts.master')

@section('script')
    <?php echo $map['js']; ?>
@stop

@section('content')
    <!--@if(Route::currentRouteName() == 'current.location' || Route::currentRouteName() == 'lots.near.current.location')
        @include('partials.geolocation')
    @elseif(Route::currentRouteName() == 'lots.near.address.web')
        @include('partials.address')
    @endif-->
    <div class="container">
        <div class="content-wrapper">
            <h3>Content Here Soon...</h3>
            <div class="col-lg-5">
            </div>
            <div class="col-lg-7">
                <?php echo $map['html']; ?>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')
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
