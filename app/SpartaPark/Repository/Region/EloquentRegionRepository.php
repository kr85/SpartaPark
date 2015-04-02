<?php namespace SpartaPark\Repository\Region;

use SpartaPark\Repository\AbstractEloquentRepository;
use Region;

/**
 * Class EloquentRegionRepository
 *
 * @package SpartaPark\Repository\Region
 */
class EloquentRegionRepository extends AbstractEloquentRepository implements RegionRepository
{
   /**
    * @var Region model
    */
   protected $region;

   /**
    * Constructor
    *
    * @param Region $region model
    */
   public function __construct(Region $region)
   {
      parent::__construct($region);
      $this->region = $region;
   }

   /**
    * Update region
    *
    * @param $id region id
    * @param array $data new data
    * @return Region updated region or false
    */
   public function update($id, array $data)
   {
      // Finds the region by id
      $region = $this->region->find($id);

      // If region doesn't exist return false
      if (!$region) {
         return false;
      }

      // Updates occupied spots
      $region->spots_occupied = $data['spots_occupied'];
      $region->save();

      return $region;
   }
}