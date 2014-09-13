<?php

/**
 * Class MainController
 */
class MainController extends BaseController
{
   /**
    * @var Lot instance
    */
   protected $lot;

   /**
    * @var Region instance
    */
   protected $region;

   /**
    * Constructor
    *
    * @param Lot $lot lot instance
    * @param Region $region region instance
    */
   public function __construct(Lot $lot, Region $region)
   {
      $this->lot    = $lot;
      $this->region = $region;
   }

   /**
    * Gets lot information by id
    *
    * @param $id lot id
    * @return array of lot information
    */
   public function getLotInfo($id)
   {
      $lots = $this->lot->find($id);
      $regions = $this->region->where('lot_id', '=', $lots->id)->get();
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

   /**
    * Gets region information by id
    *
    * @param $id region id
    * @return \Illuminate\Support\Collection|static region information
    */
   public function getRegionInfo($id)
   {
      $region = $this->region->find($id);

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