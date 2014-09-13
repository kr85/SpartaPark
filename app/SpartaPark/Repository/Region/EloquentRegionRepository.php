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
}