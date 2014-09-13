<?php

/**
 * Class MainController
 */
class MainController extends BaseController
{

   public function getLotInfo($id)
   {
      $lots = Lot::find($id);
      $regions = Region::where('lot_id', '=', $lots->id)->get();
      $lot = array(
         'id'        => $lots->id,
         'name'      => $lots->name,
         'address'   => $lots->address,
         'longitude' => $lots->longitude,
         'latitude'  => $lots->latitude,
         'regions'   => $regions
      );

      return  $lot;
   }

   public function getRegionInfo($id)
   {
      $region = Region::find($id);

      return $region;
   }

   public function getLotsNearAddress()
   {
      return 'Lots near address';
   }

   public function getLotsNearCoordinates()
   {
      return 'Lots near coordinates';
   }

}