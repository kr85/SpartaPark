<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', array(
   'as' => 'index',
   'uses' => 'WebController@getIndex'
));

Route::get('api/lot_info/lot_id/{id}', array(
   'as' => 'lot.info',
   'uses' => 'MobileController@getLotInfo'
))->where('id', '[0-9]+');

Route::get('api/region_info/region_id/{id}', array(
   'as' => 'region.info',
   'uses' => 'MobileController@getRegionInfo'
))->where('id', '[0-9]+');

Route::get('api/lots_near_address/address/{address}', array(
   'as' => 'lots.near.address',
   'uses' => 'MobileController@getLotsNearAddress'
))->where('address', '[0-9a-zA-Z\-\,\_\ \+]+');

Route::get('api/lots_near_coordinates/latitude/{latitude}/longitude/{longitude}', array(
   'as' => 'lots.near.coordinates',
   'uses' => 'MobileController@getLotsNearCoordinates'
))->where('longitude', '[0-9\.\-]+', 'latitude', '[0-9\.\-]+');