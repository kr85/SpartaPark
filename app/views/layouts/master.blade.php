<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo URL::to('assets/images/favicon.ico'); ?>">
        <title>SpartaPark  | SJSU Parking Guidance System</title>
        <meta name="description" content="A Parking Guidance System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Kosta Rashev">

        <!-- Bootstrap CSS -->
        {{ HTML::style('assets/stylesheets/bootstrap.min.css') }}
        {{ HTML::style('assets/stylesheets/bootstrap-theme.min.css') }}

        <!-- Custom CSS -->
        {{ HTML::style('assets/stylesheets/main.css') }}

        <!-- Modernizr JS -->
        {{ HTML::script('assets/javascript/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}

        <!-- Google Maps API -->
        {{ HTML::script('http://maps.googleapis.com/maps/api/js?key=AIzaSyBy9kjH-cI-tNnrMNWt6YBmgp-irYkNIb4&sensor=true') }}
        @yield('script')
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Header -->
        @include('headers.main')

        <!-- Main page carousel -->
        @if(Route::currentRouteName() == 'index')
            <div class="carousel-container">
                <div class="carousel-wrapper">
                    @include('partials.carousels.main')
                </div>
            </div>
        @endif

        <!-- Content -->
        @yield('content')

        <!-- Footer -->
        @include('footers.main')

        <!-- Javascript -->
        {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
        <script>window.jQuery || document.write('{{ HTML::script('assets/javascrpt/vendor/jquery-1.10.2.min.js\' }}')</script>
        {{ HTML::script('assets/javascript/vendor/jquery.browser.min.js') }}
        {{ HTML::script('assets/javascript/vendor/bootstrap.min.js') }}
        {{ HTML::script('assets/javascript/plugins.js') }}
        {{ HTML::script('assets/javascript/main.js') }}

        <!-- Google Analytics -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-54990766-1');ga('send','pageview');
        </script>

        <!-- Page footer assets -->
        @yield('footer-assets')
    </body>
</html>