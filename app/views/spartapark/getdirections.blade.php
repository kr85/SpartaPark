@extends('layouts.master')

@section('script')
    <script>
        var data = <?php echo json_encode($data); ?>;

        // Map variable
        var map;

        //var start = data.origin.latitude + ', ' + data.origin.longitude;
        //var end = data.destination.address;
        var start;
        var end;
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();

        function initialize()
        {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var lat = data.origin.latitude;
            var lon = data.origin.longitude;
            var center = new google.maps.LatLng(lat, lon);

            start = data.origin.latitude + ', ' + data.origin.longitude;
            end = data.destination.address;

            var mapOptions = {
                zoom: 12,
                center: center,
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
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            directionsDisplay.setMap(map);
            calcRoute();
        }

        function calcRoute()
        {
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
            }
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
        <div class="directions-map-area-wrapper">
            <div class="map-area">
                <div class="side-box" id="get-directions">
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