@extends('layouts.master')

@section('script')
    <script>
        var availableParking = <?php echo json_encode($availableParking); ?>;
        console.log(availableParking);

        var map;
        var infoWindow = new google.maps.InfoWindow;

        // Initialize the map
        function initialize()
        {
            var myLatLng = new google.maps.LatLng(37.335, -121.880);
            var mapOptions = {
                center: myLatLng,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

            //for (id ) {
            //}

            //var sjsuMarker = placeMarker(myLatLng);
            //var sjsuInfoWindow = addInfoWindow("Test");
            //var sjsuListener = addListener(sjsuMarker, 'mouseover', sjsuInfoWindow);
            //removeListener(sjsuMarker, 'mouseout');
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

        // Adds a new info window
        function addInfoWindow(content)
        {
            var infoWindow = new google.maps.InfoWindow({
                content: content
            });

            return infoWindow;
        }

        // Adds a listener
        function addListener(marker, action, infoWindow)
        {
            var listener = google.maps.event.addListener(marker, action, function() {
                infoWindow.open(map, marker);
            });

            return listener;
        }

        function removeListener(property, action)
        {
            google.maps.event.addListener(property, action, function() {
                infoWindow.close();
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@stop

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-9">
                <div class="map-canvas" id="googleMap"></div>
            </div>
        </div>
    </div>

@stop

@section('footer-assets')