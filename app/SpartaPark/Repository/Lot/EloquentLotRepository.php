<?php namespace SpartaPark\Repository\Lot;

use SpartaPark\Repository\AbstractEloquentRepository;
use Lot;

/**
 * Class EloquentLotRepository
 *
 * @package SpartaPark\Repository\Lot
 */
class EloquentLotRepository extends AbstractEloquentRepository implements  LotRepository
{
   /**
    * @var Lot model
    */
   protected $lot;

   /**
    * Constructor
    *
    * @param Lot $lot model
    */
   public function __construct(Lot $lot)
   {
      parent::__construct($lot);
      $this->lot = $lot;
   }
}