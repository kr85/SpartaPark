<?php namespace SpartaPark\Repository\Web;

use SpartaPark\Repository\AbstractEloquentRepository;
use Entranxit;

/**
 * Class EloquentWebRepository
 *
 * @package SpartaPark\Repository\Web
 */
class EloquentWebRepository extends AbstractEloquentRepository implements WebRepository
{
   /**
    * @var \Entranxit object
    */
   protected $entranxit;

   /**
    * Constructor
    *
    * @param Entranxit $entranxit object
    */
   public function __construct(Entranxit $entranxit)
   {
      parent::__construct($entranxit);
      $this->entranxit = $entranxit;
   }

   /**
    * Checks whether the object is a car or not.
    *
    * @param $image path to an image
    * @return bool true or false
    */
   public function isCar($image)
   {
      return true;
   }
}