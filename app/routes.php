<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/map', function(){
   $config = array();
   $config['center'] = 'auto';
   $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

   Gmaps::initialize($config);

   // set up the marker ready for positioning
   // once we know the users location
   $marker = array();
   Gmaps::add_marker($marker);

   $map = Gmaps::create_map();
   echo "<html><head>".$map['js']."</head><body>".$map['html']."</body></html>";
});

Route::get('api/lot_info/lot_id/{id}', array(
   'as' => 'lot.info',
   'uses' => 'MainController@getLotInfo'
))->where('id', '[0-9]+');

Route::get('api/region_info/region_id/{id}', array(
   'as' => 'region.info',
   'uses' => 'MainController@getRegionInfo'
))->where('id', '[0-9]+');

Route::get('api/lots_near_address/address/{address}', array(
   'as' => 'lots.near.address',
   'uses' => 'MainController@getLotsNearAddress'
))->where('address', '[0-9a-zA-Z\-\,\_\ \+]+');

Route::get('api/lots_near_coordinates/longitude/{longitude}/latitude/{latitude}', array(
   'as' => 'lots.near.coordinates',
   'uses' => 'MainController@getLotsNearCoordinates'
))->where('longitude', '[0-9\.]+', 'latitude', '[0-9\.]+');