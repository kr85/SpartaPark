<!-- Begin navigation bar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar-main">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navCollapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <div class="logo"></div>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navCollapse">
            <ul class="nav navbar-nav">
                <li class="available-parking-button-wrapper">
                    {{ HTML::linkRoute('parking', 'Available Parking', null, array('class' => 'btn btn-primary available-parking-button available-parking-button-text')) }}
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Route::currentRouteName() == 'index')
                    <li class="active">{{ HTML::linkRoute('index', 'Home') }}</li>
                    <li>{{ HTML::linkRoute('about', 'About') }}</li>
                    <li>{{ HTML::linkRoute('contact', 'Contact') }}</li>
                @elseif(Route::currentRouteName() == 'about')
                    <li>{{ HTML::linkRoute('index', 'Home') }}</li>
                    <li class="active">{{ HTML::linkRoute('about', 'About') }}</li>
                    <li>{{ HTML::linkRoute('contact', 'Contact') }}</li>
                @elseif(Route::currentRouteName() == 'contact')
                    <li>{{ HTML::linkRoute('index', 'Home') }}</li>
                    <li>{{ HTML::linkRoute('about', 'About') }}</li>
                    <li class="active">{{ HTML::linkRoute('contact', 'Contact') }}</li>
                @else
                    <li>{{ HTML::linkRoute('index', 'Home') }}</li>
                    <li>{{ HTML::linkRoute('about', 'About') }}</li>
                    <li>{{ HTML::linkRoute('contact', 'Contact') }}</li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- End navigation bar -->