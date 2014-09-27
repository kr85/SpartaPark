<?php namespace SpartaPark\Entranxit;

use SpartaPark\Repository\AbstractEloquentRepository;
use Entranxit;

/**
 * Class EloquentEntranxitRepository
 * 
 * @package SpartaPark\Entranxit
 */
class EloquentEntranxitRepository extends AbstractEloquentRepository implements EntranxitRepository
{
   /**
    * @var Entranxit model
    */
   protected $entranxit;

   /**
    * Constructor
    *
    * @param Entranxit $entranxit  model
    */
   public function __construct(Entranxit $entranxit)
   {
      parent::__construct($entranxit);
      $this->entranxit = $entranxit;
   }
}