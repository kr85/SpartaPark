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

        // Main map variable
        var mainMap;

        // Directions map variable
        var directionsMap;

        // Array of LatLng's of each marker
        var latLngList;

        // View point bound
        var bounds;

        // Array of all markers
        var allMarkers;

        // Info window
        var infoWindow = new google.maps.InfoWindow;

        var addressDirections;

        // Initialize the map
        function initialize()
        {
            latLngList = new Array();
            bounds = new google.maps.LatLngBounds();
            allMarkers = new Array();

            // New point with latitude and longitude
            var myLatLng = new google.maps.LatLng(owner.latitude, owner.longitude);
            // Add the point to the array
            latLngList.push(myLatLng);

            // Main map options
            var mainMapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDoubleClickZoom: true,
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

            // Directions map options
            var directionsMapOptions = {
                center: myLatLng,
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                panControl: false,
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

            // Main map object
            mainMap = new google.maps.Map(document.getElementById("map-canvas"), mainMapOptions);

            // Directions map object
            directionsMap = new google.maps.Map(document.getElementById("map-directions-canvas"), directionsMapOptions);

            // SJSU marker
            var sjsuMarker = placeMarker(mainMap, myLatLng);
            //var testMarker = placeMarker(directionsMap, myLatLng);

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
            bindInfoWindow(sjsuMarker, mainMap, infoWindow, html, html);

            // Initialize each lot point
            for (id in lots) {
                initializePoint(lots[id]);
            }

            // Increase the bounds (include all points)
            var i;
            for (i = 0; i < latLngList.length; i++) {
                bounds.extend(latLngList[i]);
            }

            // Fit and pan bounds to map
            mainMap.fitBounds(bounds);
            mainMap.panToBounds(bounds);
        }

        // Initialize each lot
        function initializePoint(lotData)
        {
            // New point with latitude and longitude
            var lotLatLng = new google.maps.LatLng(lotData.latitude, lotData.longitude);
            latLngList.push(lotLatLng);

            // Lot id
            var lotDataId = lotData.id;

            // New marker
            var marker = new google.maps.Marker({
                position: lotLatLng,
                map: mainMap,
                title: lotData.name,
                icon: "assets/images/parkinggarage3.png"
            });

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

            htmlMore += addressLine1 + '<br />' + addressLine2 + '<div>' +
                '<a data-toggle="modal" data-target="#directionsModal">Get Directions</a>' +
                '<div class="hide" id="parking-name">' + lotData.name +
                '</div><div class="hide" id="address">' + address + '</div><div id="latitude" class="">' + lotData.latitude + '</div><div id="longitude" class="">' + lotData.longitude + '</div></div>' +
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

            bindInfoWindow(marker, mainMap, infoWindow, html, htmlMore ,lotData.id);

            var windowSize = $(window).width();

            if (windowSize > 767) {
                createLotEntryWeb(marker, lotData);
            } else {
                createLotEntryMobile(marker, lotData);
            }

            allMarkers.push(marker);
            marker.setMap(mainMap);
        }

        // Binds info window on hover
        function bindInfoWindow(marker, mainMap, infoWindow, html, htmlMore ,id)
        {
            var id = "lot-" + id;

            // Add mouseover listener
            mouseoverListener(marker, html);

            // Add mouseout listener
            mouseoutListener(marker, html);

            // Add click on marker listener
            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(htmlMore);
                infoWindow.open(mainMap, marker);
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
            google.maps.event.addListener(mainMap, 'click', function() {
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
                    infoWindow.open(mainMap, marker);
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
        function placeMarker(map, location)
        {
            var marker = new google.maps.Marker({
                position: location
            });

            marker.setMap(map);

            return marker;
        }

        function addLatLng(latitude, longitude)
        {
            var newLatLng = new google.maps.LatLng(latitude, longitude);
            latLngList.push(newLatLng);
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
                google.maps.event.trigger(mainMap, "click");
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

        // Displays destination name and address to form
        function displayDestinationName()
        {
            var address = $('#address').text();
            var name = $('#parking-name').text();
            $('.parking-address address').html(address);
            $('.parking-name a').html(name);
        }

        function displayDestinationMarker()
        {
            var name = $('#parking-name').text();
            var latitude = $('#latitude').text();
            var longitude = $('#longitude').text();
            var destinationLatLng = new google.maps.LatLng(latitude, longitude);
            console.log(destinationLatLng);

            // New marker
            var marker = new google.maps.Marker({
                position: destinationLatLng,
                map: directionsMap,
                title: name,
                icon: "assets/images/parkinggarage3.png"
            });

            marker.setMap(directionsMap);
            directionsMap.setCenter(destinationLatLng);

            return marker;
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, 'resize', function() {
            var center = mainMap.getCenter();
            var dirCenter = directionsMap.getCenter();

            //var bounds = mainMap.getBounds();

            google.maps.event.trigger(mainMap, 'resize');
            google.maps.event.trigger(directionsMap, 'resize');

            mainMap.setCenter(center);
            directionsMap.setCenter(dirCenter);

            //mainMap.fitBounds(bounds);
            //mainMap.panToBounds(bounds);
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
                <div id="map-canvas"></div>
            </div>
        </div>
        <div id="directionsModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <div style="display: inline; font-size: 16px;">Close </div>
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="directions-map-area-wrapper">
                            <div class="map-area">
                                <div class="side-box" id="get-directions">
                                    <div class="get-directions-container">
                                        <h3 class="get-directions-title">Get Directions</h3>
                                        <div class="get-directions-content">
                                            {{ Form::open(array('route' => 'post_directions')) }}
                                                <div class="origin">
                                                    <label>From</label>
                                                    <div class="address-field">
                                                        <div class="nested-icon-text-field">
                                                            <div class="student-location">
                                                                <span class="glyphicon glyphicon-map-marker"></span>
                                                                <input id="" name="" type="text"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="destination">
                                                    <label>To</label>
                                                    <div class="parking-location">
                                                        <div class="glyphicon parking-icon"></div>
                                                        <div class="parking-address">
                                                            <div class="parking-name">
                                                                <a></a>
                                                            </div>
                                                            <address></address>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="search-directions">
                                                    <a class="btn btn-primary pull-right">Get Directions</a>
                                                </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                                <div id="map-directions-canvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')
    <script>
        $(function() {



            $('#directionsModal').on('shown.bs.modal', function() {
                var center = directionsMap.getCenter();
                google.maps.event.trigger(directionsMap, 'resize');
                directionsMap.setCenter(center);
                displayDestinationName();
                displayDestinationMarker();
            });

            $(window).resize(function () {
                var widnow = $(window).height(),
                    offsetTop = 60,
                    offsetBottom = 200;
                $('#map-directions-canvas').css('height', (widnow - offsetBottom));
                $('#map-canvas').css('height', (widnow - offsetTop));
            }).resize();
        });
    </script>
@stop