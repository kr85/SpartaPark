<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', array(
   'as' => 'index',
   'uses' => 'MainController@getIndex'
));

Route::get('api/lot_info/lot_id/{id}', array(
   'as' => 'lot.info',
   'uses' => 'MainController@getLotInfo'
))->where('id', '[0-9]+');

Route::get('api/region_info/region_id/{id}', array(
   'as' => 'region.info',
   'uses' => 'MainController@getRegionInfo'
))->where('id', '[0-9]+');

Route::get('api/lots_near_address/address/', array(
   'as' => 'lots.near.address',
   'uses' => 'MainController@getLotsNearAddress'
))->where('address', '[0-9a-zA-Z\-\,\_\ \+]+');

Route::get('api/lots_near_coordinates/', array(
   'as' => 'lots.near.coordinates',
   'uses' => 'MainController@getLotsNearCoordinates'
))->where('longitude', '[0-9\.]+', 'latitude', '[0-9\.\-]+');

Route::get('address/', array(
   'as' => 'address',
   'uses' => 'MainController@getNearestLocationsFromDB'
));