@extends('layouts.master')

@section('script')
    <script>
        // SJSU information
        var owner = {
            'name':      'San Jose State University',
            'address':   '1 Washington Square, San Jose, CA 95192',
            'phone':     '(408) 924-1000',
            'latitude':  37.3353235,
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

        // Info windows main map
        var allInfoWindowsMainMap;

        // Info windows directions map
        var allInfoWindowsDirectionsMap;

        // All markers on directions map
        var directionsMapMarkers;

        // Add additional markers
        var additionalMarkers;

        // Display directions variable
        var directionsDisplay;

        // New directions service
        var directionsService = new google.maps.DirectionsService();

        // Directions origin and destination marker icons
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
            directionsDisplay           = null;
            latLngList                  = new Array();
            bounds                      = new google.maps.LatLngBounds();
            allMarkers                  = new Array();
            allInfoWindowsMainMap       = new Array();
            allInfoWindowsDirectionsMap = new Array();
            directionsMapMarkers        = new Array();
            additionalMarkers           = new Array();

            // New point with latitude and longitude
            var centerLatLng = new google.maps.LatLng(owner.latitude, owner.longitude);

            // Add the point to the array
            latLngList.push(centerLatLng);

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
                center: centerLatLng,
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
            var sjsuMarker = placeMarker(mainMap, centerLatLng, true);

            // SJSU info window
            var sjsuInfoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(sjsuInfoWindow);

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
            bindInfoWindow(sjsuMarker, sjsuInfoWindow, html, html, null);

            // Initialize each lot point
            for (id in lots) {
                initializeMainParking(lots[id]);
            }

            // Initialize additional parking
            initializeAdditionalParking();

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
        function initializeMainParking(lotData)
        {
            // Check if the lot has regions
            if (lotData.regions.length > 0) {

                // New point with latitude and longitude
                var lotLatLng = new google.maps.LatLng(lotData.latitude, lotData.longitude);
                latLngList.push(lotLatLng);

                // Lot id
                var lotDataId = lotData.id;

                // Place marker on each point
                var marker = placeMarker(mainMap, lotLatLng, true, "assets/images/parkinggarage3.png", lotData.name);

                // Marker's info window
                var infoWindow = new google.maps.InfoWindow;
                allInfoWindowsMainMap.push(infoWindow);

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
                    '<div style="text-align: center; padding-left: 20px;"><small><i>Click for more info</i></small></div>';

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

                var regionTableBody = '';

                for (var l = 0; l < lots.length; l++) {
                    var regions = lots[l].regions;
                    for (var r = 0; r < regions.length; r++) {
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
        }

        // Initialize additional parking
        function initializeAdditionalParking()
        {
            // Park & Ride
            var location = new google.maps.LatLng(lots[18].latitude, lots[18].longitude);
            var marker = placeMarker(mainMap, location, false, "assets/images/parkandride.png", "Park & Ride");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            var infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            var html = createInfoWindowPublicParkingContent(lots[18], false);
            var htmlMore = createInfoWindowPublicParkingContent(lots[18], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[18].id);
            createLotEntryWeb(marker, lots[18]);

            // Street Parking
            location = new google.maps.LatLng(lots[5].latitude, lots[5].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking-meter-export.png", "Street Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[5], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[5], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[5].id);
            createLotEntryWeb(marker, lots[5]);

            // Street Parking
            location = new google.maps.LatLng(lots[6].latitude, lots[6].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking-meter-export.png", "Street Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[6], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[6], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[6].id);
            createLotEntryWeb(marker, lots[6]);

            // Street Parking
            location = new google.maps.LatLng(lots[8].latitude, lots[8].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking-meter-export.png", "Street Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[8], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[8], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[8].id);
            createLotEntryWeb(marker, lots[8]);

            // Street Parking
            location = new google.maps.LatLng(lots[9].latitude, lots[9].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking-meter-export.png", "Street Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[9], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[9], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[9].id);
            createLotEntryWeb(marker, lots[9]);

            // Public Parking
            location = new google.maps.LatLng(lots[11].latitude, lots[11].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking.png", "Public Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[11], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[11], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[11].id);
            createLotEntryWeb(marker, lots[11]);

            // Public Parking
            location = new google.maps.LatLng(lots[13].latitude, lots[13].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking.png", "Public Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[13], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[13], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[13].id);
            createLotEntryWeb(marker, lots[13]);

            // Public Parking
            location = new google.maps.LatLng(lots[14].latitude, lots[14].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking.png", "Public Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[14], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[14], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[14].id);
            createLotEntryWeb(marker, lots[14]);

            // Public Parking
            location = new google.maps.LatLng(lots[15].latitude, lots[15].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking.png", "Public Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[15], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[15], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[15].id);
            createLotEntryWeb(marker, lots[15]);

            // Public Parking
            location = new google.maps.LatLng(lots[16].latitude, lots[16].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking.png", "Public Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[16], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[16], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[16].id);
            createLotEntryWeb(marker, lots[16]);

            // Public Parking
            location = new google.maps.LatLng(lots[17].latitude, lots[17].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking.png", "Public Parking");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowPublicParkingContent(lots[17], false);
            htmlMore = createInfoWindowPublicParkingContent(lots[17], true);
            bindInfoWindow(marker, infoWindow, html, htmlMore, lots[17].id);
            createLotEntryWeb(marker, lots[17]);

            // San Carlos Plaza marker
            location = new google.maps.LatLng(lots[0].latitude, lots[0].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking_bicycle.png", "San Carlos Plaza");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            var html = createInfoWindowBesContent(lots[0]);
            bindInfoWindow(marker, infoWindow, html, html, lots[0].id);
            createLotEntryWeb(marker, lots[0]);

            // MacQuarrie Quad marker
            location = new google.maps.LatLng(lots[3].latitude, lots[3].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking_bicycle.png", "MacQuarrie Quad");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowBesContent(lots[3]);
            bindInfoWindow(marker, infoWindow, html, html ,lots[3].id);
            createLotEntryWeb(marker, lots[3]);

            // Spartan Memorial Paseo marker
            location = new google.maps.LatLng(lots[7].latitude, lots[7].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking_bicycle.png", "Spartan Memorial Paseo");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowBesContent(lots[7]);
            bindInfoWindow(marker, infoWindow, html, html ,lots[7].id);
            createLotEntryWeb(marker, lots[7]);

            // 7th Street Plaza marker
            location = new google.maps.LatLng(lots[2].latitude, lots[2].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking_bicycle.png", "7th Street Plaza");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowBesContent(lots[2]);
            bindInfoWindow(marker, infoWindow, html, html ,lots[2].id);
            createLotEntryWeb(marker, lots[2]);

            // 9th Street Plaza marker
            location = new google.maps.LatLng(lots[1].latitude, lots[1].longitude);
            marker = placeMarker(mainMap, location, false, "assets/images/parking_bicycle.png", "9th Street Plaza");
            allMarkers.push(marker);
            additionalMarkers.push(marker);
            infoWindow = new google.maps.InfoWindow;
            allInfoWindowsMainMap.push(infoWindow);
            html = createInfoWindowBesContent(lots[1]);
            bindInfoWindow(marker, infoWindow, html, html ,lots[1].id);
            createLotEntryWeb(marker, lots[1]);
        }

        // Create info window content for bicycle enclosure sites
        function createInfoWindowBesContent(lotData)
        {
            // Info window content
            var html = '<strong style="font-size: 15px; line-height: 1.5; margin-bottom: 10px;">' + lotData.name +
                '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                '<div class="pull-right"></div><br />';

            var address = lotData.address;
            var addressLine1 = address.split(",")[0];
            if (address.split(",")[2]) {
                var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];
            } else {
                var addressLine2 = address.split(",")[1];
            }

            html += addressLine1 + '<br />' + addressLine2;

            return html;
        }

        function createInfoWindowPublicParkingContent(lotData, isClicked)
        {
            // Html content variable
            var html;

            // Round distance to two decimal places
            var distance = Math.round(lotData.distance * 100) / 100;

            // Info window content
            html = '<strong style="font-size: 15px; line-height: 1.5; margin-bottom: 10px;">' + lotData.name +
                '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                '<div class="pull-right">' + distance + ' miles</div><br />';

            // Formats the address
            var address = lotData.address;
            if (address.split(",")[0].indexOf('(') === -1) {
                var addressLine1 = address.split(",")[0];
            } else {
                var addressLine1 = address.split(",")[0];
                addressLine1 = addressLine1.split("(")[0] + '<br />(' + addressLine1.split("(")[1];
            }
            if (address.split(",")[2]) {
                var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];
            } else {
                var addressLine2 = address.split(",")[1];
            }

            // Check if isClicked is true or false
            if (!isClicked) {

                html += addressLine1 + '<br />' + addressLine2 +
                    '<hr><div style="text-align: center; padding-left: 20px;"><small><i>Click for more info</i></small></div>';

            } else {

                html += addressLine1 + '<br />' + addressLine2 + '<div>' +
                    '<a data-toggle="modal" data-target="#directionsModal">Get Directions</a>' +
                    '<div class="hide" id="parking-name">' + lotData.name +
                    '</div><div class="hide" id="address">' + address + '</div>' +
                    '<div id="latitude" class="hide">' + lotData.latitude + '</div>' +
                    '<div id="longitude" class="hide">' + lotData.longitude + '</div></div>' +
                    '<hr><div style="text-align: center; padding-left: 20px;"><small><i>Double click to close</i></small></div>';
            }


            return html;
        }

        // Binds info window on hover
        function bindInfoWindow(marker, infoWindow, html, htmlMore, id)
        {
            var infoWindowHover = infoWindow;
            var infoWindowClick = infoWindow;

            if (id != null) {
                // Lot id
                var id = "lot-" + id;
            }

            // Add mouseover listener
            mouseoverListener(marker, html);

            // Add mouseout listener
            mouseoutListener(marker, html);

            // Add click on marker listener
            google.maps.event.addListener(marker, 'click', function() {
                closeAllInfoWindows(allInfoWindowsMainMap);
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
                closeAllInfoWindows(allInfoWindowsMainMap);
                $("div").removeClass("lot-entry-active");
                $("div").removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Add double click on marker listener
            google.maps.event.addListener(marker, 'dblclick', function() {
                closeAllInfoWindows(allInfoWindowsMainMap);
                $("div").removeClass("lot-entry-active");
                $("div").removeClass("lot-entry-hover");
                mouseoutListener(marker, html);
                mouseoverListener(marker, html);
            });

            // Add close info window listener
            google.maps.event.addListener(infoWindowClick, 'closeclick', function() {
                closeAllInfoWindows(allInfoWindowsMainMap);
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
                    closeAllInfoWindows(allInfoWindowsMainMap);
                    $("#" + id).removeClass("lot-entry-active");
                    $("#" + id).removeClass("lot-entry-hover");
                });
            }
        }

        // Close any open info windows
        function closeAllInfoWindows(infoWindowList)
        {
            for (var i = 0; i < infoWindowList.length; i++) {
                infoWindowList[i].close();
            }
        }

        // Places a new marker
        function placeMarker(map, location, isVisible, icon, name)
        {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                visible: isVisible
            });

            // Check if icon is null
            if (icon != null) {
                marker.setIcon(icon);
            }

            // Check if name is null
            if (name != null) {
                marker.setTitle(name);
            }

            return marker;
        }

        // Show additional parking
        function addAdditionalMarkers()
        {
            // Go through each one
            for (var i = 0; i < additionalMarkers.length; i++) {
                additionalMarkers[i].setVisible(true);
                $('#additional-sidebar-' + i).removeClass('hide');
            }

            // Set center and zoom
            var centerLatLng = new google.maps.LatLng(37.329676, -121.876394);
            mainMap.setCenter(centerLatLng);
            mainMap.setZoom(15);
        }

        // Hide additional parking
        function removeAdditionalMarkers()
        {
            // Go through each one
            for (var i = 0; i < additionalMarkers.length; i++) {
                additionalMarkers[i].setVisible(false);
                $('#additional-sidebar-' + i).addClass('hide');
            }

            // Set center and zoom
            var centerLatLng = new google.maps.LatLng(owner.latitude, owner.longitude);
            mainMap.setCenter(centerLatLng);
            mainMap.setZoom(16);
        }

        // Create a lot entry to the sidebar for web
        function createLotEntryWeb(marker, lotData)
        {
            var ul = document.getElementById("marker-list");
            var li = document.createElement("li");
            ul.appendChild(li);

            // Check if the lot has regions
            if (lotData.regions.length > 0) {

                var distance = Math.round(lotData.distance * 100) / 100;

                var html = '<div class="lot-entry" id="lot-' + lotData.id + '"><div class="lot-entry-container unselectable">' +
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
            } else {

                var distance = Math.round(lotData.distance * 100) / 100;
                var moreInfo;

                if (lotData.name === "Bicycle Enclosure Site") {
                    distance = '&mdash;';
                    moreInfo = '';
                } else {
                    distance = distance + ' miles';
                    moreInfo = 'Click for more info';
                }

                var html = '<div id="additional-sidebar-' + (lotData.id - 4) + '" class="hide"><div class="lot-entry" id="lot-' +
                    lotData.id + '"><div class="lot-entry-container unselectable">' +
                    '<div class="lot-entry-name" id="lot-name">' + lotData.name + '</div>' +
                    '<div class="pull-right" id="lot-distance">' + distance + '</div><br />';

                var address = lotData.address;
                if (address.split(",")[0].indexOf('(') === -1) {
                    var addressLine1 = address.split(",")[0];
                } else {
                    var addressLine1 = address.split(",")[0];
                    addressLine1 = addressLine1.split("(")[0] + '<br >(' + addressLine1.split("(")[1];
                }
                if (address.split(",")[2]) {
                    var addressLine2 = address.split(",")[1] + ", " + address.split(",")[2];
                } else {
                    var addressLine2 = address.split(",")[1];
                }

                html += addressLine1 + '<br />' + addressLine2 + '<div style="display: inline;" class="pull-right"><small><i>' + moreInfo + '</i></small></div></div>';
            }

            li.innerHTML = html;

            // Add dom listeners
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
            var address;
            // Format the address
            if ($('#address').text().indexOf('(') === -1) {
                address = $('#address').text();
            } else {
                var a = $('#address').text();
                var a1 = a.split("(")[0];
                var a2 = a.split(")")[1];

                address = a1 + a2;
            }

            var name = $('#parking-name').text();
            $('.parking-address address').html(address);
            $('.parking-name a').html(name);
        }

        // Clear directions map
        function clearDirectionsMap()
        {
            clearDirectionsMapMarkers();
            clearDirectionsDisplay();
            closeAllInfoWindows(allInfoWindowsDirectionsMap);
        }

        // Display destination marker
        function displayDestinationMarker()
        {
            var name = $('#parking-name').text();
            var latitude = $('#latitude').text();
            var longitude = $('#longitude').text();
            var destinationLatLng = new google.maps.LatLng(latitude, longitude);

            // Clear directions map
            clearDirectionsMap();

            // Destination marker
            var parkingMarker = placeMarker(directionsMap, destinationLatLng, true, "assets/images/parking.png", name);

            directionsMapMarkers.push(parkingMarker);

            parkingMarker.setMap(directionsMap);
            directionsMap.setCenter(destinationLatLng);
            directionsMap.setZoom(17);
        }

        // Calculate route and pin markers
        function calculateRoute(origin, destination)
        {
            // Renderer options
            var rendererOptions = {
                map: directionsMap,
                suppressMarkers: true,
                preserveViewport: false
            };

            // Clear directions map
            clearDirectionsMap();

            // Create a new directions renderer
            directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

            // Set the map for directions display
            directionsDisplay.setMap(directionsMap);

            // Request variable options
            var request = {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            };

            // Call route on directions service
            directionsService.route(request, function(response, status) {

                // Check directions status
                if (status == google.maps.DirectionsStatus.OK) {

                    // Clear directions panel
                    $('#directions-panel').empty();

                    // Set the directions
                    directionsDisplay.setDirections(response);

                    // The first leg of this route
                    var leg = response.routes[0].legs[0];

                    // Add the directions panel
                    addDirectionsPanel(leg);

                    // Get directions origin value
                    var origin = $('#directions-origin').val();

                    // Add the origin marker
                    var originMarker = addDirectionsMarker(leg.start_location, icons.start, origin);

                    // Add the origin marker to the directions map markers array
                    directionsMapMarkers.push(originMarker);

                    // Destination value
                    var destination;
                    // Destination marker
                    var destinationMarker;
                    if ($('#parking-name').text() === "Street Parking") {
                        var latitude = $('#latitude').text();
                        var longitude = $('#longitude').text();
                        destination = new google.maps.LatLng(latitude, longitude);
                        destinationMarker = addDirectionsMarker(destination, icons.end, $('#parking-name').text());
                    } else {
                        destination = $('#address').text();
                        destinationMarker = addDirectionsMarker(leg.end_location, icons.end, destination);
                    }

                    // Add the destination marker
                    //var destinationMarker = addDirectionsMarker(leg.end_location, icons.end, destination);

                    // Add the destination marker to the directions map markers array
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

        // Add directions panel
        function addDirectionsPanel(leg)
        {
            // Get directions panel
            var panel = document.getElementById('directions-panel');

            // Create start address element
            var startTable = document.createElement('table');
            panel.appendChild(startTable);
            addStartAddress(startTable, leg);

            // Create summary element
            var summary = document.createElement('table');
            panel.appendChild(summary);
            addDirectionsSummary(summary, leg);

            // Create directions steps element
            var stepsTable = document.createElement('table');
            panel.appendChild(stepsTable);
            addStepPointsToRoute(stepsTable, leg);

            // Create end address element
            var endTable = document.createElement('table');
            panel.appendChild(endTable);
            addEndAddress(endTable, leg);
        }

        // Add start address
        function addStartAddress(startTable, leg)
        {
            // Create new row
            var tr = document.createElement('tr');

            // Append the row to the table
            startTable.appendChild(tr);

            // Start address html
            var html = '<td id="adp-placemark" class="adp-step">' + leg.start_address + '</td>';

            // Add html to the row
            tr.innerHTML = html;

            // Step position
            var position = leg.start_location;

            // Add start location as a marker to the map
            var marker = placeMarker(directionsMap, position, false, null, null);

            var infoWindow = new google.maps.InfoWindow;
            allInfoWindowsDirectionsMap.push(infoWindow);

            // Add a custom listener to the marker
            addListenerMarkerClick(marker, infoWindow, leg.start_address);

            // Add a dom listener to the row
            addDomListenerClick(tr, marker)
        }

        // Add route summary
        function addDirectionsSummary(summary, leg)
        {
            // Create new row
            var tr = document.createElement('tr');

            // Append the row to the table
            summary.appendChild(tr);

            // Summary html
            var html = '<td class="adp-summary-duration">' + leg.distance.text + ' - about ' + leg.duration.text + '</td>';
            tr.innerHTML = html;
        }

        // Add end address
        function addEndAddress(endTable, leg)
        {
            // Create new row
            var tr = document.createElement('tr');

            // Append the row to the table
            endTable.appendChild(tr);

            var html = '<td class="adp-placemark adp-step">' + leg.end_address + '</td>';

            // Add html to the row
            tr.innerHTML = html;

            // Step position
            var position = leg.end_location;

            // Add end location as a marker to the map
            var marker = placeMarker(directionsMap, position, false, null, null);

            var infoWindow = new google.maps.InfoWindow;
            allInfoWindowsDirectionsMap.push(infoWindow);

            // Add a custom listener to the marker
            addListenerMarkerClick(marker, infoWindow, leg.end_address);

            // Add a dom listener to the row
            addDomListenerClick(tr, marker)
        }

        // Add point to the map for each step
        function addStepPointsToRoute(stepsTable, leg)
        {
            // Go through each step
            for (var i = 0; i < leg.steps.length; i++) {

                // Step position
                var position = leg.steps[i].start_location;

                // Add step as a marker to the map
                var marker = placeMarker(directionsMap, position, false, null, null);

                var infoWindow = new google.maps.InfoWindow;
                allInfoWindowsDirectionsMap.push(infoWindow);

                // Add a custom listener to the marker
                addListenerMarkerClick(marker, infoWindow, leg.steps[i].instructions);

                // Add the step to the directions text panel
                addDirectionsSteps(stepsTable, marker, leg.steps[i], i);
            }
        }

        // Add the directions steps
        function addDirectionsSteps(stepsTable, marker, steps, i)
        {
            // Create new row
            var tr = document.createElement('tr');

            // Append the row to the table
            stepsTable.appendChild(tr);

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

            // Check if teh step has a maneuver
            if (steps.maneuver === "") {
                $("#adp-stepicon-" + i).addClass("hide");
            } else {
                $("#maneuver-" + i).addClass("adp-" + steps.maneuver);
            }

            // Add a dom listener to the row
            addDomListenerClick(tr, marker);
        }

        // Add a custom marker click listener
        function addListenerMarkerClick(marker, infoWindow, html)
        {
            google.maps.event.addListener(marker, 'click', function() {
                closeAllInfoWindows(allInfoWindowsDirectionsMap);
                infoWindow.setContent(html);
                infoWindow.open(directionsMap, marker);
                directionsMap.setCenter(marker.getPosition());
                directionsMap.setZoom(17);
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
                <div class="additional-parking-button-container">
                    <div class="checkbox">
                        <label>
                            <div class="btn additional-parking-button">
                                <input type="checkbox" id="additional-parking">Additional Parking
                            </div>
                        </label>
                    </div>
                </div>
                <div class="sidebar-container">
                    <ul id="marker-list"></ul>
                </div>
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

            // On click show or remove additional markers
            $('#additional-parking').click(function() {
                if ($('#additional-parking').is(':checked')) {
                    addAdditionalMarkers();
                } else {
                    removeAdditionalMarkers();
                }
            });

            // On click use current location
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
                                var destination;
                                if ($('#parking-name').text() === "Street Parking") {
                                    var latitude = $('#latitude').text();
                                    var longitude = $('#longitude').text();
                                    destination = new google.maps.LatLng(latitude, longitude);
                                } else {
                                    destination = $('#address').text();
                                }
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

            // On click search directions
            $('#search-directions').click(function() {

                // Submit get directios form
                $('#calculate-route').submit(function(event) {
                    clearDirectionsMap();
                    event.preventDefault();
                    var origin = $('#directions-origin').val();
                    var destination;
                    if ($('#parking-name').text() === "Street Parking") {
                        var latitude = $('#latitude').text();
                        var longitude = $('#longitude').text();
                        destination = new google.maps.LatLng(latitude, longitude);
                    } else {
                        destination = $('#address').text();
                    }

                    calculateRoute(origin, destination);
                });

                setupDirectionsPanelStyles();
            });

            // On modal shown
            $('#directionsModal').on('shown.bs.modal', function() {

                // Clear directions map
                clearDirectionsMap();

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
                clearDirectionsMap();

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
                    boxHeight = 278,
                    additionalParkingButtonOffset = 138;

                $('#map-directions-canvas').css('height', (widnow - offsetBottom));
                $('#map-canvas').css('height', (widnow - offsetTop));
                $('#sidebar').css('height', (widnow - offsetTop));
                $('#marker-list').css('height', (widnow - additionalParkingButtonOffset));
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
                if ($('#directions-origin').val() !== "") {
                    $('.side-box').css('height', (windowHeight - bottomOffset));
                    $('#scroll-box').css('height', (windowHeight - bottomOffset - 8));
                    $('#scroll-box').css('width', scrollboxWidth);


                    // Remove hide class
                    $('#directions-panel-break').removeClass('hide');
                }
            }
        });
    </script>
@stop