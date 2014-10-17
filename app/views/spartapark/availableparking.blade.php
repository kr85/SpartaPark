@extends('layouts.master')

@section('script')
    <script>
        // SJSU information
        var owner = {
            'name': 'San Jose State University',
            'address': '1 Washington Square, San Jose, CA 95192',
            'phone': '(408) 924-1000',
            'latitude': 37.3353235,
            'longitude': -121.8804712
        };

        // All lots
        var lots = <?php echo json_encode($availableParking); ?>;

        // Map variable
        var map;

        // Array of all markers
        var allMarkers = new Array();

        // Info window
        var infoWindow = new google.maps.InfoWindow;

        // Initialize the map
        function initialize()
        {
            // New point with latitude and longitude
            var myLatLng = new google.maps.LatLng(owner.latitude, owner.longitude);

            // Map options
            var mapOptions = {
                center: myLatLng,
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                panControl: true,
                panControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_TOP
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE,
                    position: google.maps.ControlPosition.RIGHT_TOP
                },
                scaleControl: true,
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_TOP
                }
            };

            // New map object
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            // SJSU marker
            var sjsuMarker = placeMarker(myLatLng);

            // SJSU info window
            //var sjsuInfoWindow = new google.maps.InfoWindow;

            // Creates maker's info window content
            var html = '<strong style="font-size: 15px; line-height: 1.5; margin-bottom: 10px;">' + owner.name +
                  '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />' +
                  '<hr style="margin-top: 10px; margin-bottom: 10px;">';
            var address = owner.address;
            var addressLine1 = address.split(",")[0];
            var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];
            html = html + addressLine1 + '<br />' + addressLine2 + '<br />' + owner.phone + '<br />' +
                '<a href="http://www.sjsu.edu/">Web Site</a><hr style="margin-top: 8px; margin-bottom: 8px;">' +
                '<a href="http://en.wikipedia.org/wiki/San_Jose_State_University" style="font-size: 13px; float: right;">' +
                '<strong>See Details</strong></a>';

            // Add marker to array
            allMarkers.push(sjsuMarker);

            // Binds the info window to the marker for mouseover
            bindInfoWindow(sjsuMarker, map, infoWindow, html, html);

            // Initialize each lot point
            for (id in lots) {
                initializePoint(lots[id]);
            }

        }

        // Initialize each lot
        function initializePoint(lotData)
        {
            // New point with latitude and longitude
            var lotLatLng = new google.maps.LatLng(lotData.latitude, lotData.longitude);

            // Lot id
            var lotDataId = lotData.id;

            // New marker
            var marker = new google.maps.Marker({
                position: lotLatLng,
                map: map,
                title: lotData.name,
                icon: "assets/images/parkinggarage3.png"
            });

            marker.metadata = { type: "point", id: lotDataId };

            // Round distance to two decimal places
            var distance = Math.round(lotData.distance * 100) / 100;

            // Info window content
            var html = '<strong style="font-size: 15px; line-height: 1.5; margin-bottom: 10px;">' + lotData.name +
                  '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                  '<div class="pull-right">' + distance + ' miles</div><br />';
            var address = lotData.address;
            var addressLine1 = address.split(",")[0];
            var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];

            // Conditions whether available parking should be green or red and spots singular or plural
            if (lotData.spots_available == 0) {
                var spots = "Spots";
                var color = "red"
            }
            else if (lotData.spots_available == 1) {
                var spots = "Spot";
                var color = "green"
            } else {
                var spots = "Spots"
                var color = "green";
            }


            htmlMore = html;
            html += addressLine1 + '<br />' + addressLine2 +
                '<hr><div style="color: ' + color + '; font-size: 16px; font-weight: bolder; ' +
                'vertical-align: middle; text-align: center; padding-bottom: 14px;"><strong>' +
                lotData.spots_available + ' Available Parking ' + spots + '</strong></div>' +
                '<div style="text-align: center;"><small><i>Click for more info</i></small></div>';

            htmlMore += addressLine1 + '<br />' + addressLine2 + '<div><a href="/get_directions/address/' + lotData.address + '">Get Directions</a></div>' +
                '<hr><div style="color: ' + color + '; font-size: 16px; font-weight: bolder; ' +
                'vertical-align: middle; text-align: center; padding-bottom: 14px;"><strong>' +
                lotData.spots_available + ' Available Parking ' + spots + '</strong></div>';

            htmlMore += '<hr style="margin-top: 6px;">';

            var regionTable = '<table style="width: 100%; padding-bottom: 30px;"><tr><td style="font-size: 14px;">' +
                '<strong>Region</strong></td><td class="pull-right" style="font-size: 14px;"><strong>Available' +
                '</strong></td></tr>';

            var l;
            var r;
            var regionTableBody = '';

            for (l = 0; l < lots.length; l++) {
                var regions = lots[l].regions;
                for (r = 0; r < regions.length; r++) {
                    var lotId = regions[r].lot_id;

                    if (lotDataId == lotId) {
                        regionTableBody += '<tr><td>' + regions[r].name +
                        '</td><td class="pull-right">' + regions[r].spots_available + '</td></tr>';
                    }
                }
            }

            regionTable += regionTableBody + '</table>';

            htmlMore += regionTable + '<hr>' +
                '<div style="margin-left: 95px; margin-bottom: 0px; padding-bottom: 0px;"><small><i>Double click to close</i></small></div>';

            bindInfoWindow(marker, map, infoWindow, html, htmlMore ,lotData.id);

            var windowSize = $(window).width();

            if (windowSize > 767) {
                createLotEntryWeb(marker, lotData);
            } else {
                createLotEntryMobile(marker, lotData);
            }

            allMarkers.push(marker);
            marker.setMap(map);
        }

        // Binds info window on hover
        function bindInfoWindow(marker, map, infoWindow, html, htmlMore ,id)
        {
            var id = "lot-" + id;

            // Add mouseover listener
            mouseoverListener(marker, html);

            // Add mouseout listener
            mouseoutListener(marker, html);

            // Add click on marker listener
            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(htmlMore);
                infoWindow.open(map, marker);
                $("div").removeClass("lot-entry-hover");
                $("div").removeClass("lot-entry-active");
                $("#" + id).addClass("lot-entry-active");
                var i;
                for (i = 0; i < allMarkers.length; i++)
                {
                    google.maps.event.clearListeners(allMarkers[i], 'mouseover');
                    google.maps.event.clearListeners(allMarkers[i], 'mouseout');
                }
            });

            // Add click on map listener
            google.maps.event.addListener(map, 'click', function() {
                infoWindow.close();
                $("div").removeClass("lot-entry-active");
                $("div").removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Add double click on marker listener
            google.maps.event.addListener(marker, 'dblclick', function() {
                infoWindow.close();
                $("div").removeClass("lot-entry-active");
                $("div").removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Add close info window listener
            google.maps.event.addListener(infoWindow, 'closeclick', function() {
                infoWindow.close();
                $("#" + id).removeClass("lot-entry-active");
                $("#" + id).removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Helper function for marker mouseover effects
            function mouseoverListener(marker, html)
            {
                google.maps.event.addListener(marker, 'mouseover', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                    $("div").removeClass("lot-entry-hover");
                    $("#" + id).addClass("lot-entry-hover");
                });
            }

            // Helper function for marker mouseout effects
            function mouseoutListener(marker, html)
            {
                google.maps.event.addListener(marker, 'mouseout', function() {
                    infoWindow.close();
                    $("#" + id).removeClass("lot-entry-active");
                    $("#" + id).removeClass("lot-entry-hover");
                });
            }
        }

        // Places a new marker
        function placeMarker(location)
        {
            var marker = new google.maps.Marker({
                position: location
            });

            marker.setMap(map);

            return marker;
        }

        // Create a lot entry to the sidebar for web
        function createLotEntryWeb(marker, lotData)
        {
            var ul = document.getElementById("marker-list");
            var li = document.createElement("li");

            var distance = Math.round(lotData.distance * 100) / 100;

            var html = '<div class="lot-entry" id="lot-' + lotData.id + '"><div class="lot-entry-container">' +
                '<div class="lot-entry-name" id="lot-name">' + lotData.name + '</div>' +
                '<div class="pull-right" id="lot-distance">' + distance + ' miles</div><br />';

            var address = lotData.address;
            var addressLine1 = address.split(",")[0];
            var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];

            if (lotData.spots_available == 0) {
                var spots = "spots";
                var color = "red"
            }
            else if (lotData.spots_available == 1) {
                var spots = "Spot";
                var color = "green"
            } else {
                var spots = "Spots"
                var color = "green";
            }

            html += addressLine1 + '<br />' + addressLine2 + '<br /><div style="display: inline; color: ' +
                color + ';"><strong>' + lotData.spots_available + ' Available Parking ' + spots +
                '</strong></div><div class="pull-right"><small><i>Click for more info</i></small></div>';

            li.innerHTML = html;
            ul.appendChild(li);

            google.maps.event.addDomListener(li, "mouseover", function(){
                google.maps.event.trigger(marker, "mouseover");
            });

            google.maps.event.addDomListener(li, "mouseout", function(){
                google.maps.event.trigger(marker, "mouseout");
            });

            google.maps.event.addDomListener(li, "click", function(){
                google.maps.event.trigger(marker, "click");
            });

            google.maps.event.addDomListener(li, "dblclick", function() {
                google.maps.event.trigger(map, "click");
            });

        }

        // Create a lot entry to the sidebar for mobile
        function createLotEntryMobile(marker, lotData)
        {
            var ul = document.getElementById("marker-list");
            var li = document.createElement("li");
            li.id = "lot-" + lotData.id;
            var liId = li.id;
            console.log(li);
            console.log(liId);

            var distance = Math.round(lotData.distance * 100) / 100;

            var html = '<div class="lot-entry" id="lot-' + lotData.id + '"><div class="lot-entry-container">' +
                '<div class="lot-entry-name" id="lot-name">' + lotData.name + '</div>' +
                '<div class="pull-right" id="lot-distance">' + distance + ' miles</div><br />';

            var address = lotData.address;
            var addressLine1 = address.split(",")[0];
            var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];

            if (lotData.spots_available == 0) {
                var spots = "spots";
                var color = "red"
            }
            else if (lotData.spots_available == 1) {
                var spots = "Spot";
                var color = "green"
            } else {
                var spots = "Spots"
                var color = "green";
            }

            html += addressLine1 + '<br />' + addressLine2 + '<br /><div style="display: inline; color: ' +
                color + ';"><strong>' + lotData.spots_available + ' Available Parking ' + spots +
                '</strong></div><div style="display: inline;" class="pull-right"><small><i>Click for more info</i></small></div>';

            var regionTable = '<table style="width: 100%; padding-bottom: 30px;"><tr><td style="font-size: 14px;">' +
                '<strong>Region</strong></td><td class="pull-right" style="font-size: 14px;"><strong>Available' +
                '</strong></td></tr>';

            var lotDataId = lotData.id;
            var l;
            var r;
            var regionTableBody = '';

            for (l = 0; l < lots.length; l++) {
                var regions = lots[l].regions;
                for (r = 0; r < regions.length; r++) {
                    var lotId = regions[r].lot_id;

                    if (lotDataId == lotId) {
                        regionTableBody += '<tr><td>' + regions[r].name +
                        '</td><td class="pull-right">' + regions[r].spots_available + '</td></tr>';
                    }
                }
            }

            regionTable += regionTableBody + '</table>';

            htmlMore += addressLine1 + '<br />' + addressLine2 + '<br /><div style="display: inline; color: ' +
                color + ';"><strong>' + lotData.spots_available + ' Available Parking ' + spots +
                '</strong></div><div style="display: inline;" class="pull-right"><small><i>Click for more info</i></small></div>';

            htmlMore += regionTable;

            li.innerHTML = html;
            ul.appendChild(liId);

            google.maps.event.addDomListener(li, "mouseover", function(){
                google.maps.event.trigger(marker, "mouseover");
            });

            google.maps.event.addDomListener(li, "mouseout", function(){
                google.maps.event.trigger(marker, "mouseout");
            });

            google.maps.event.addDomListener(li, "click", function(){
              if (liId == li.id) {
                    li.innerHTML = htmlMore;
                    ul.appendChild(li.id);
                    google.maps.event.trigger(marker, "click");
              }
            });

            google.maps.event.addDomListener(li, "dblclick", function(){
                li.innerHTML = html;
                ul.appendChild(li);
                google.maps.event.trigger(marker, "dblclick");
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, 'resize', function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, 'resize');
            map.setCenter(center);
        });
    </script>
@stop

@section('content')
    <div class="content-wrapper">
        <div class="sidebar-map-area-wrapper">
            <div class="sidebar" id="sidebar">
                <div class="all-parking-button-container">
                    <div class="checkbox">
                        <label>
                            <div class="btn all-parking-button">
                                <input type="checkbox">All Parking
                            </div>
                        </label>
                    </div>
                </div>
                <ul id="marker-list"></ul>
            </div>
            <div class="map-area">
                <div class="side-box hide" id="get-directions">
                    <h3>Get Directions</h3>

                    {{ Form::open(array('route' => 'post_directions')) }}

                    {{ Form::close() }}
                </div>
                <div id="map-canvas"></div>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')
    <script>
        $(function() {
            $(window).resize(function () {
                var header = $(window).height(),
                    offsetTop = 60;
                $('#map-canvas').css('height', (header - offsetTop));
            }).resize();

        });
    </script>
@stop