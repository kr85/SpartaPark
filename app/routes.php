<?php

/*
|--------------------------------------------------------------------------
| Error Handling
|--------------------------------------------------------------------------
*/

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/*
 |--------------------------------------------------------------------------
 |  General Exceptions
 |--------------------------------------------------------------------------
*/
App::error(function(Exception $exception)
{
   if(Config::get('app.debug') === true) {
      return null;
   }

   return View::make('error');
});

/*
 |--------------------------------------------------------------------------
 | 404 Exception
 |--------------------------------------------------------------------------
 */
App::error(function(NotFoundHttpException $exception)
{
   if(Config::get('app.debug') === true) {
      return null;
   }

   return View::make('error.404');
});

/*
 |--------------------------------------------------------------------------
 | Web Service Routes
 |--------------------------------------------------------------------------
 */

Route::get('/', array(
   'as'   => 'index',
   'uses' => 'WebController@getIndex'
));

Route::get('about', array(
   'as'   => 'about',
   'uses' => 'WebController@getAbout'
));

Route::get('contact', array(
   'as'   => 'contact',
   'uses' => 'WebController@getContact'
));

Route::post('contact', array(
   'as'   => 'contact.request',
   'uses' => 'WebController@postContact'
));

Route::get('parking', array(
   'as'   => 'parking',
   'uses' => 'WebController@getAvailableParking'
));

Route::post('api/upload_image/lot_id/{lot_id}/region_id/{region_id}/orientation/{orientation}', array(
   'as'     => 'upload.images',
   'before' => 'raspberry_pi',
   'uses'   => 'WebController@uploadImage'
))->where(array('lot_id'      => '[0-9]+',
                'region_id'   => '[0-9]+',
                'orientation' => '[a-zA-Z]+'));

/*
 \--------------------------------------------------------------------------
 | Mobile Service Routes
 |--------------------------------------------------------------------------
 */
Route::get('api/lot_info/lot_id/{lot_id}', array(
   'as'   => 'lot.info',
   'uses' => 'MobileController@getLotInfo'
))->where('lot_id', '[0-9]+');

Route::get('api/region_info/region_id/{region_id}', array(
   'as'   => 'region.info',
   'uses' => 'MobileController@getRegionInfo'
))->where('region_id', '[0-9]+');

Route::get('api/lots_near_address/address/{address}', array(
   'as'   => 'lots.near.address',
   'uses' => 'MobileController@getLotsNearAddress'
))->where('address', '[0-9a-zA-Z\-\,\_\ \+]+');

Route::get('api/lots_near_coordinates/latitude/{latitude}/longitude/{longitude}', array(
   'as'   => 'lots.near.coordinates',
   'uses' => 'MobileController@getLotsNearCoordinates'
))->where('longitude', '[0-9\.\-]+', 'latitude', '[0-9\.\-]+');

Route::get('api/available_near_address/address/{address}', array(
   'as'   => 'available.near.address',
   'uses' => 'MobileController@getAvailableNearAddress'
))->where('address', '[0-9a-zA-Z\-\,\_\ \+]+');

Route::get('api/available_near_coordinates/latitude/{latitude}/longitude/{longitude}', array(
   'as'   => 'available.near.coordinates',
   'uses' => 'MobileController@getAvailableNearCoordinates'
))->where('longitude', '[0-9\.\-]+', 'latitude', '[0-9\.\-]+');