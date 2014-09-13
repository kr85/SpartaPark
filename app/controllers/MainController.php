<?php

use SpartaPark\Repository\Lot\LotRepository;

/**
 * Class MainController
 */
class MainController extends BaseController
{
   /**
    * @var SpartaPark\Repository\Lot\LotRepository lot repository
    */
   protected $lotRepository;

   /**
    * @var Region instance
    */
   protected $region;


   public function __construct(LotRepository $lotRepository, Region $region)
   {
      $this->lotRepository    = $lotRepository;
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
      $lot = $this->lotRepository->find($id, array('regions'));
      $lot = array(
         'id'        => $lot->id,
         'name'      => $lot->name,
         'address'   => $lot->address,
         'longitude' => $lot->longitude,
         'latitude'  => $lot->latitude,
         'regions'   => $lot->regions
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