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
                        <h3 class="about-title">ABOUT SPARTAPARK</h3>
                        <p class="about-text">
                            Parking guidance systems assist drivers in locating available parking spots.
                            These systems use various types of sensors to detect vehicles and a screen outside
                            the garage to display occupancy. Other commercial products use expensive sensors
                            mounted on the ceiling or embedded in the walls or floor to detect vehicles entering
                            and exiting the parking structure. These devices, however, are all expensive and most
                            of them require construction to install. Current systems also do not address users’
                            need to find out where parking is available without physically driving to each garage.
                        </p>
                        <p class="about-text">
                            The objective of SpartaPark is to provide students, instructors, and staff a hassle
                            free experience in locating a parking spot in the campus parking structures through
                            web and mobile applications. Assisting drivers in locating vacant parking will allow
                            the parking structure optimal capacity while reducing traffic congestion, drivers’
                            stress, and pollution.
                        </p>
                        <p class="about-text">
                            SpartaPark exemplifies how the industry can leverage the power of the Internet of
                            Things, which is an expanding market in our field that companies are rushing to take
                            advantage of. It also has important academic ramifications because it serves as a case
                            study of how to identify expensive and limited hardware-based systems and replace them
                            with smart software. SpartaPark is poised to show how software innovation can bring
                            forward better solutions to common problems at a dramatically reduced cost.
                        </p>
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
            // Show about tab on click
            $("#about").click(function() {
                $(".about").show();
                $(".team").hide();
                $("li#team").removeClass("active");
                $("li#about").addClass("active");
            });

            // Show meet the team tab on click
            $("#team").click(function() {
                $(".team").show();
                $(".about").hide();
                $("li#about").removeClass("active");
                $("li#team").addClass("active");
            });

            // Style the footer
            $('.footer-wrapper').css('box-shadow', '0 0 10px grey');
        });
    </script>
@stop
