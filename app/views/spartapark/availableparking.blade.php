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

        // Info windows
        var allInfoWindows;

        // All markers on directions map
        var directionsMapMarkers;

        // Display directions variable
        var directionsDisplay;

        // New directions service
        var directionsService = new google.maps.DirectionsService();

        var icons = {
            start: new google.maps.MarkerImage(
                'assets/images/home.png',
                new google.maps.Size(32, 37),
                new google.maps.Point(0, 0),
                new google.maps.Point(16, 37)
            ),
            end: new google.maps.MarkerImage(
                'assets/images/parking.png',
                new google.maps.Size(32, 37),
                new google.maps.Point(0, 0),
                new google.maps.Point(16, 37)
            )
        };

        // Initialize the map
        function initialize()
        {
            directionsDisplay = null;
            latLngList = new Array();
            bounds = new google.maps.LatLngBounds();
            allMarkers = new Array();
            allInfoWindows = new Array();
            directionsMapMarkers = new Array();

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

            // SJSU info window
            var sjsuInfoWindow = new google.maps.InfoWindow;
            allInfoWindows.push(sjsuInfoWindow);

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
            bindInfoWindow(sjsuMarker, mainMap, sjsuInfoWindow, html, html);

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

            var infoWindow = new google.maps.InfoWindow;
            allInfoWindows.push(infoWindow);

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
                '</div><div class="hide" id="address">' + address + '</div>' +
                '<div id="latitude" class="hide">' + lotData.latitude + '</div>' +
                '<div id="longitude" class="hide">' + lotData.longitude + '</div></div>' +
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

            bindInfoWindow(marker, infoWindow, html, htmlMore ,lotData.id);

            createLotEntryWeb(marker, lotData);

            allMarkers.push(marker);
            marker.setMap(mainMap);
        }

        // Binds info window on hover
        function bindInfoWindow(marker, infoWindow, html, htmlMore ,id)
        {
            var infoWindowHover = infoWindow;
            var infoWindowClick = infoWindow;

            // Lot id
            var id = "lot-" + id;

            // Add mouseover listener
            mouseoverListener(marker, html);

            // Add mouseout listener
            mouseoutListener(marker, html);

            // Add click on marker listener
            google.maps.event.addListener(marker, 'click', function() {
                closeAllInfoWindows();
                infoWindowClick.setContent(htmlMore);
                infoWindowClick.open(mainMap, marker);
                $("div").removeClass("lot-entry-hover");
                $("div").removeClass("lot-entry-active");
                $("#" + id).addClass("lot-entry-active");
                for (var i = 0; i < allMarkers.length; i++)
                {
                    google.maps.event.clearListeners(allMarkers[i], 'mouseover');
                    google.maps.event.clearListeners(allMarkers[i], 'mouseout');
                }
            });

            // Add click on map listener
            google.maps.event.addListener(mainMap, 'click', function() {
                closeAllInfoWindows();
                $("div").removeClass("lot-entry-active");
                $("div").removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Add double click on marker listener
            google.maps.event.addListener(marker, 'dblclick', function() {
                closeAllInfoWindows();
                $("div").removeClass("lot-entry-active");
                $("div").removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Add close info window listener
            google.maps.event.addListener(infoWindowClick, 'closeclick', function() {
                closeAllInfoWindows();
                $("#" + id).removeClass("lot-entry-active");
                $("#" + id).removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Helper function for marker mouseover effects
            function mouseoverListener(marker, html)
            {
                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infoWindowHover.setContent(html);
                        infoWindowHover.open(mainMap, marker);
                        $("div").removeClass("lot-entry-hover");
                        $("#" + id).addClass("lot-entry-hover");
                    });
            }

            // Helper function for marker mouseout effects
            function mouseoutListener(marker, html)
            {
                google.maps.event.addListener(marker, 'mouseout', function() {
                    closeAllInfoWindows();
                    $("#" + id).removeClass("lot-entry-active");
                    $("#" + id).removeClass("lot-entry-hover");
                });
            }
        }

        // Close any open info windows
        function closeAllInfoWindows()
        {
            var i;
            for (i = 0; i < allInfoWindows.length; i++) {
                allInfoWindows[i].close();
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

            addDomListenerMouseover(li, marker);
            addDomListenerMouseout(li, marker);
            addDomListenerClick(li, marker);
            addDomListenerDblClick(li, mainMap);
        }

        // Add a mouseover listener to sidebar entry
        function addDomListenerMouseover(dom, marker)
        {
            google.maps.event.addDomListener(dom, "mouseover", function(){
                google.maps.event.trigger(marker, "mouseover");
            });
        }

        // Add a mouseout listener to sidebar entry
        function addDomListenerMouseout(dom, marker)
        {
            google.maps.event.addDomListener(dom, "mouseout", function() {
                google.maps.event.trigger(marker, "mouseout");
            });
        }

        // Add a click listener to sidebar entry
        function addDomListenerClick(dom, marker)
        {
            google.maps.event.addDomListener(dom, "click", function() {
                google.maps.event.trigger(marker, "click");
            });
        }

        // Add a double click listener to sidebar entry
        function addDomListenerDblClick(dom, map)
        {
            google.maps.event.addDomListener(dom, "dblclick", function() {
                google.maps.event.trigger(map, "click");
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

        // Display destination marker
        function displayDestinationMarker()
        {
            var name = $('#parking-name').text();
            var latitude = $('#latitude').text();
            var longitude = $('#longitude').text();
            var destinationLatLng = new google.maps.LatLng(latitude, longitude);

            clearDirectionsMapMarkers();
            clearDirectionsDisplay();

                // New marker
                var parkingMarker = new google.maps.Marker({
                    position: destinationLatLng,
                    map: directionsMap,
                    title: name,
                    icon: "assets/images/parkinggarage3.png"
                });

                directionsMapMarkers.push(parkingMarker);

                parkingMarker.setMap(directionsMap);
                directionsMap.setCenter(destinationLatLng);
                directionsMap.setZoom(17);
        }

        // Calculate route and pin markers
        function calculateRoute(origin, destination)
        {
            var rendererOptions = {
                map: directionsMap,
                suppressMarkers: true,
                preserveViewport: false
            };

            clearDirectionsMapMarkers();
            clearDirectionsDisplay();

            directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
            directionsDisplay.setMap(directionsMap);
            //$('#directions-panel').empty();
            //directionsDisplay.setPanel(document.getElementById('directions-panel'));

            var request = {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    $('#directions-panel').empty();
                    directionsDisplay.setDirections(response);
                    var leg = response.routes[0].legs[0];

                    //var steps = directionsDisplay.directions.routes[0].legs[0].steps;
                    console.log(leg);

                    //var table = document.getElementById('directions-panel');
                    //addStepPointsToRoute(table, leg);
                    addDirectionsPanel(leg);

                    var origin = $('#directions-origin').val();
                    var originMarker = addDirectionsMarker(leg.start_location, icons.start, origin);
                    directionsMapMarkers.push(originMarker);

                    var destination = $('#address').text();
                    var destinationMarker = addDirectionsMarker(leg.end_location, icons.end, destination);
                    directionsMapMarkers.push(destinationMarker);
                } else {
                    if (status == 'ZERO_RESULTS') {
                        alert('No route found between the origin and destination points.');
                    } else if (status == 'UNKNOWN_ERROR') {
                        alert('The request could not be processed due to a server error. Please try again.');
                    } else if (status == 'REQUEST_DENIED') {
                        alert('The directions service was denied for this webpage.');
                    } else if (status == 'OVER_QUERY_LIMIT') {
                        alert('The webpage has gone over the requests limit in too short a period of time.');
                    } else if (status == 'NOT_FOUND') {
                        alert('Either origin, destination or both could not be geocoded.');
                    } else if (status == 'INVALID_REQUEST') {
                        alert('The request provided was invalid.');
                    } else {
                        alert('There was an unknown error in your request. Request status: ' + status);
                  }
                }
            });
        }

        function addDirectionsPanel(leg)
        {
            var panel = document.getElementById('directions-panel');

            var startTable = document.createElement('table');
            panel.appendChild(startTable);

            var stepsTable = document.createElement('table');
            panel.appendChild(stepsTable);
            addStepPointsToRoute(stepsTable, leg);

            var endTable = document.createElement('table');
            panel.appendChild(endTable);

            //var table = document.getElementById('directions-panel');
            //var trStart = document.createElement('tr');
            //var startHtml = '' + leg.start_address + '';
            //trStart.innerHTML = startHtml;
            //table.appendChild(trStart);

            //addStepPointsToRoute(table, leg);

            //var trEnd = document.createElement('tr');
            //var endHtml = '' + leg.end_address + '';
            //trEnd.innerHTML = endHtml;
            //table.appendChild(trEnd);
        }

        function addStepPointsToRoute(stepsTable, leg)
        {
            for (var i = 0; i < leg.steps.length; i++) {

                var position = leg.steps[i].start_location;
                var marker = new google.maps.Marker({
                    position: position,
                    map: directionsMap,
                });

                marker.setVisible(false);
                addListenerMarkerClick(marker);
                addDirectionsSteps(stepsTable, marker, leg.steps[i], i);
            }
        }

        // Add the directions steps
        function addDirectionsSteps(stepsTable, marker, steps, i)
        {
            // Create new row
            var tr = document.createElement('tr');

            // Maneuver column
            var maneuver = '<td class="adp-substep"><div id="adp-stepicon-' + i +
                '" class="adp-stepicon"><div id="maneuver-' + i + '" class="adp-maneuver"></div></div></td>';

            // Step number column
            var stepNumber = '<td class="adp-substep">' + (i + 1) + '.</td>';

            // Instructions column
            var instructions = '<td class="adp-substep">' + steps.instructions + '</td>';

            // Distance column
            var distance = '<td class="adp-substep"><div class="adp-distance">' + steps.distance.text + '</div></td>';

            // Bind together all columns
            var html = maneuver + stepNumber + instructions + distance;

            // Add html to the row
            tr.innerHTML = html;

            // Append the row to the table
            stepsTable.appendChild(tr);

            // Check if teh step has a maneuver
            if (steps.maneuver === "") {
                $("#adp-stepicon-" + i).addClass("hide");
            } else {
                $("#maneuver-" + i).addClass("adp-" + steps.maneuver);
            }

            // Add a dom listener to the row
            addDomListenerClick(tr, marker)
        }

        // Add a custom marker click listener
        function addListenerMarkerClick(marker)
        {
            google.maps.event.addListener(marker, 'click', function() {
                directionsMap.setZoom(17);
                directionsMap.setCenter(marker.getPosition());
            });
        }

        function addListenerInfoWindowReady(infoWindow, html)
        {
            google.maps.event.addListener(infoWindow, 'domready', function() {
                infoWindow.setContent(html);
            });
        }

        // Clear the directions route
        function clearDirectionsDisplay()
        {
            // Delete the directions route
            if (directionsDisplay != null) {
                directionsDisplay.setMap(null);
                directionsDisplay = null;
            }
        }

        // Clear the markers on the directions map
        function clearDirectionsMapMarkers()
        {
            while (directionsMapMarkers.length) {
                directionsMapMarkers.pop().setMap(null);
            }

            directionsMapMarkers.length = 0;
            directionsMapMarkers = new Array();
        }

        // Add custom directions markers
        function addDirectionsMarker(position, icon, title)
        {
            var marker = new google.maps.Marker({
                position: position,
                map: directionsMap,
                icon: icon,
                title: title
            });
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

        google.maps.Map.prototype.setCenterWithOffset = function(latLng, offsetX, offsetY) {

        };
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
                                <div class="scroll-box-container">
                                    <div id="scroll-box">
                                        <div class="get-directions-container">
                                            <h3 class="get-directions-title">Get Directions</h3>
                                            <div class="get-directions-content">
                                                <form id="calculate-route" action="#" method="get">
                                                    <div class="origin">
                                                        <label for="from" class="from-label">From</label>
                                                        <div class="current-location pull-right"><a href="#" id="current-location">Use Current Location</a></div>
                                                        <div class="address-field">
                                                            <div class="nested-icon-text-field">
                                                                <div class="student-location">
                                                                    <div class="glyphicon home-icon"></div>
                                                                    <input id="directions-origin" name="directions-origin" required="required" type="text" autocomplete="off" class="textarea-style">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="destination">
                                                        <label for="to">To</label>
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
                                                        <input class="btn btn-primary pull-right btn-style" id="search-directions" type="submit" value="GO">
                                                    </div>
                                                </form>
                                            </div>
                                            <div id="directions-panel-break" class="hide">
                                                <br /><hr>
                                            </div>
                                            <div id="directions-panel"></div>
                                        </div>
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

            // On use current location click
            $('#current-location').click(function(event) {

                // Check if browser supports geolocation
                if (typeof navigator.geolocation == 'undefined') {
                    alert("Your browser doesn't support the Geolocation API!");
                    return;
                } else {
                    event.preventDefault();
                    var pos;
                    navigator.geolocation.getCurrentPosition(function(position) {
                        pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({
                            'location': pos
                        },
                        function(results, status) {
                            if (status = google.maps.GeocoderStatus.OK) {
                                $('#directions-origin').val("My Location");
                                var destination = $('#address').text();
                                calculateRoute(pos, destination);
                                setupDirectionsPanelStyles();
                            } else {
                                alert("Unable to retrieve your location.");
                            }
                        });
                    },
                    function(error) {
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                alert("Access to Geolocation API denied by user.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                alert("Unable to determine location.");
                                break;
                            case error.TIMEOUT:
                                alert("Unable to determine location, the request timed out.");
                                break;
                            case error.UNKNOWN_ERROR:
                                alert("An unknown error occured.");
                                break;
                            default:
                                alert("Error: " + positionError.message);
                        }
                    });
                }
            });

            // On search directions click
            $('#search-directions').click(function() {

                // Submit get directios form
                $('#calculate-route').submit(function(event) {
                    clearDirectionsMapMarkers();
                    clearDirectionsDisplay();
                    event.preventDefault();
                    var origin = $('#directions-origin').val();
                    var destination = $('#address').text();
                    calculateRoute(origin, destination);
                });

                setupDirectionsPanelStyles();
            });

            // On modal shown
            $('#directionsModal').on('shown.bs.modal', function() {

                // Clear directions map
                clearDirectionsMapMarkers();
                clearDirectionsDisplay();

                // Get center, set and resize the map
                var center = directionsMap.getCenter();
                google.maps.event.trigger(directionsMap, 'resize');
                directionsMap.setCenter(center);

                // Display destination name/info to form
                displayDestinationName();

                // Display marker to directions map
                displayDestinationMarker();
            });

            // On modal hidden
            $('#directionsModal').on('hidden.bs.modal', function() {

                // Box height
                var boxHeight = 278;

                // Clear directions map
                clearDirectionsMapMarkers();
                clearDirectionsDisplay();

                // Clear directions panel
                $('#directions-panel').empty();

                // Reset get directions form
                document.getElementById('calculate-route').reset();

                // Style side-box and scroll-box
                $('.side-box').css('height', boxHeight);
                $('#scroll-box').css({
                    'overflow': 'hidden',
                    'height': boxHeight
                });

                // Hide break line
                $('#directions-panel-break').addClass('hide');
            });

            // Resize maps on window change
            $(window).resize(function () {
                var widnow = $(window).height(),
                    offsetTop = 60,
                    offsetBottom = 200,
                    offsetBottomModal = 240,
                    sideboxMinHeight = 350,
                    scrollboxMinHeight = 343,
                    boxHeight = 278;

                $('#map-directions-canvas').css('height', (widnow - offsetBottom));
                $('#map-canvas').css('height', (widnow - offsetTop));
                $('.side-box').css('height', (widnow - offsetBottomModal));
                $('#scroll-box').css('height', (widnow - offsetBottomModal - 8));

                if ($('#directions-panel-break').hasClass('hide')) {
                    $('.side-box').css('height', boxHeight);
                    $('#scroll-box').css('height', boxHeight);
                } else {
                    $('.side-box').css('height', (widnow - offsetBottomModal));
                    $('.side-box').css('min-height', sideboxMinHeight);
                    $('#scroll-box').css('height', (widnow - offsetBottomModal - 8));
                    $('#scroll-box').css('min-height', scrollboxMinHeight);
                }
            }).resize();

            // Custom scroll
            $('#scroll-box').enscroll({
                showOnHover: false,
                verticalHandleClass: 'handle'
            });

            // Setup styles for directions panel
            function setupDirectionsPanelStyles()
            {
                // Window height and offsets
                var windowHeight = $(window).height(),
                    bottomOffset = 240,
                    scrollboxWidth = 360;

                // Style side-box and sctoll-box
                $('.side-box').css('height', (windowHeight - bottomOffset));
                $('#scroll-box').css('height', (windowHeight - bottomOffset - 8));
                $('#scroll-box').css('width', scrollboxWidth);

                // Remove hide class
                $('#directions-panel-break').removeClass('hide');
            }
        });
    </script>
@stop