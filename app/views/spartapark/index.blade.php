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
        // Map
        var map;
        // Info window
        var infoWindow = new google.maps.InfoWindow;

        // Initialize the map
        function initialize()
        {
            var myLatLng = new google.maps.LatLng(owner.latitude, owner.longitude);
            var mapOptions = {
                center: myLatLng,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

            // Initialize each lod
            for (id in lots) {
                initializePoint(lots[id]);
            }

            // Add SJSU marker
            var sjsuMarker = placeMarker(myLatLng);

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

            // Binds the info window to the marker for mouseover
            bindInfoWindow(sjsuMarker, map, infoWindow, html);

            // Binds the info window to the marker for mouse click
            bindInfoWindowOnClick(sjsuMarker, map, infoWindow, html);
        }

        // Initialize each lot
        function initializePoint(lotData)
        {
            var lotLatLng = new google.maps.LatLng(lotData.latitude, lotData.longitude);
            var lotDataId = lotData.id;

            var marker = new google.maps.Marker({
                position: lotLatLng,
                map: map,
                title: lotData.name,
                icon: "assets/images/parkinggarage3.png"
            });

            var distance = Math.round(lotData.distance * 100) / 100;

            var html = '<strong style="font-size: 15px; line-height: 1.5; margin-bottom: 10px;">' + lotData.name +
                  '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                  '<div class="pull-right">' + distance + ' miles</div><br />';

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

            html = html + addressLine1 + '<br />' + addressLine2 +
                '<hr><div style="color: ' + color + '; font-size: 16px; font-weight: bolder; ' +
                'vertical-align: middle; text-align: center; padding-bottom: 14px;"><strong>' +
                lotData.spots_available + ' Available Parking ' + spots + '</strong></div>';

            bindInfoWindow(marker, map, infoWindow, html, lotData.id);

            html = html + '<hr style="margin-top: 6px;">';

            var regionTable = '<table style="width: 100%; padding-bottom: 30px;"><tr><td style="font-size: 14px;">' +
                '<strong>Region</strong></td><td class="pull-right" style="font-size: 14px;"><strong>Available' +
                '</strong></td></tr>'

            var l;
            var r;
            var regionTableBody = '';

            for (l = 0; l < lots.length; l++) {
                var regions = lots[l].regions;
                for (r = 0; r < regions.length; r++) {
                    var lotId = regions[r].lot_id;

                    if (lotDataId == lotId) {
                        regionTableBody = regionTableBody + '<tr><td>' + regions[r].name +
                        '</td><td class="pull-right">' + regions[r].spots_available + '</td></tr>';
                    }
                }
            }

            regionTable = regionTable + regionTableBody + '</table>';

            html = html + regionTable + '<hr><a href="#" style="float: right; padding-bottom: 10px; font-size: 13px;">' +
                '<strong>Directions</strong></a>';

            bindInfoWindowOnClick(marker, map, infoWindow, html, lotData.id);

            marker.setMap(map);
        }

        // Binds info window on hover
        function bindInfoWindow(marker, map, infoWindow, html, id)
        {
            var id = "#lot-" + id;

            google.maps.event.addListener(marker, 'mouseover', function() {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });

            google.maps.event.addListener(marker, 'mouseout', function() {
                infoWindow.close();
            });
        }

        // Binds info window on click
        function bindInfoWindowOnClick(marker, map, infoWindow, html, id)
        {
            var id = "#lot-" + id;

            google.maps.event.addListener(marker, 'click', function() {
                google.maps.event.clearListeners(marker, 'mouseout');
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });

            google.maps.event.addListener(map, 'click', function() {
                infoWindow.close();
                google.maps.event.addListener(marker, 'mouseout', function() {
                    infoWindow.close();
                });
            });
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

        google.maps.event.addDomListener(window, 'click', function() {
            //infoWindow.close();
        });

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@stop

@section('content')
    <div class="container">
        <div class="content-wrapper">
            <h3>Content Here Soon...</h3>
            <div class="row">
                <div class="col-md-6 col-lg-5">
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="index-map-canvas" id="googleMap"></div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <h3>Some other content here...</h3>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')
    @if(Route::currentRouteName() == 'index')
        <script>
           // Sets navbar to transparent
           $(function() {
              $('.navbar').css({
                  'background': 'transparent',
                  'border': 'transparent'
              });
              $('.navbar-default').css({
                  'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
              });

              $(window).scroll(function() {
                  // Sets navbar to black after scroll
                  if ($(this).scrollTop() > 150) {
                      $('.navbar').css({
                          'background': 'black',
                          'border': 'black',
                          'box-shadow': '2px 2px 2px black'
                      });
                  } else {
                      // Sets navbar to transparent
                      $('.navbar').css({
                          'background': 'transparent',
                          'border': 'transparent',
                          'box-shadow': '0px 0px 0px rgba(255, 255, 255, 0)'
                      });
                  }
              });
           });
        </script>
    @endif
@stop
