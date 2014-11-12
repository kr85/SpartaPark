<footer class="footer-wrapper">
    <div class="container">
        <div class="row vertical-align">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-push-1">
                <div class="pull-left">
                    <div class="footer-logo">
                    </div>
                    <div class="copyright">
                        &copy; Copyright 2014
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <ul>
                    <li class="footer-nav vertical-align-footer-nav">
                        {{ HTML::linkRoute('index', 'Home') }}
                    </li>
                    <li class="footer-nav vertical-align-footer-nav">
                        {{ HTML::linkRoute('about', 'About') }}
                    </li>
                    <li class="footer-nav vertical-align-footer-nav">
                        {{ HTML::linkRoute('contact', 'Contact') }}
                    </li>
                    <li class="pull-right vertical-align-back-to-top col-xs-pull-1">
                        <a href="#top">
                            <div class="back-to-top">
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>