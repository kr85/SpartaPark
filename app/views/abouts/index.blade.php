@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="content-wrapper content-wrapper-navbar-push">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active" id="about"><a>About Us</a></li>
                        <li id="team"><a>Meet The Team</a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="about">
                        <h3 class="about-title">About SpartaPark</h3>
                    </div>
                    <div class="team" style="display: none;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-premd-6 col-md-4">
                                <div class="thumbnail">
                                    <div class="team-member-image img-thumbnail">
                                    </div>
                                    <div class="caption">
                                        <p class="team-member-name">Daniel Franklin</p>
                                        <p class="team-member-position">Co-Founder and Hardware Engineer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-premd-6 col-md-4">
                                <div class="thumbnail">
                                    <div class="team-member-image img-thumbnail">
                                    </div>
                                    <div class="caption">
                                        <p class="team-member-name">Kosta Rashev</p>
                                        <p class="team-member-position">Co-Founder and Web Service Engineer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-premd-6 col-md-4">
                                <div class="thumbnail">
                                    <div class="team-member-image img-thumbnail">
                                    </div>
                                    <div class="caption">
                                        <p class="team-member-name">Nergal Issaie</p>
                                        <p class="team-member-position">Co-Founder and Mobile Software Engineer</p>
                                    </div>
                                </div>
                            </div>
                        <!--</div>
                        <div class="row">-->
                            <div class="col-xs-12 col-sm-4 col-premd-6 col-md-4">
                                <div class="thumbnail">
                                    <div class="team-member-image img-thumbnail">
                                    </div>
                                    <div class="caption">
                                        <p class="team-member-name">Odkhuu Batmunkh</p>
                                        <p class="team-member-position">Co-Founder and Mobile Software Engineer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-premd-6 col-md-4">
                                <div class="thumbnail">
                                    <div class="team-member-image img-thumbnail">
                                    </div>
                                    <div class="caption">
                                        <p class="team-member-name">Patrick Roteman</p>
                                        <p class="team-member-position">Co-Founder and Software Engineer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-premd-6 col-md-4">
                                <div class="thumbnail">
                                    <div class="team-member-image img-thumbnail">
                                    </div>
                                    <div class="caption">
                                        <p class="team-member-name">Thuy Nguyen</p>
                                        <p class="team-member-position">Co-Founder and Hardware Engineer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')
    <script>
        $(function() {
            $("#about").click(function() {
                $(".about").show();
                $(".team").hide();
                $("li#team").removeClass("active");
                $("li#about").addClass("active");
            });

        $("#team").click(function() {
                $(".team").show();
                $(".about").hide();
                $("li#about").removeClass("active");
                $("li#team").addClass("active");
            });
        });
    </script>
@stop
