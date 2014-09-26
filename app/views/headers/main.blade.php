<!-- Fixed navigation bar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="logo" href="/"></a>
            <div class="row">
                <div class="header-text">
                    <div class="title">
                        SpartaPark
                    </div>
                    <div class="subtitle">
                        Guidance Parking System
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>{{ HTML::link('', 'HOME') }}</li>
                <li>{{ HTML::link('', 'ABOUT') }}</li>
                <li>{{ HTML::link('', 'CONTACT US') }}</li>
            </ul>
        </div>
    </div>
</nav>