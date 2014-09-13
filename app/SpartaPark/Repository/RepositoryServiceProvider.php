<?php namespace SpartaPark\Repository;

use Illuminate\Support\ServiceProvider;
use SpartaPark\Repository\Lot\EloquentLotRepository;
use SpartaPark\Repository\Owner\EloquentOwnerRepository;
use Owner;
use Lot;

/**
 * Class RepositoryServiceProvider
 *
 * @package SpartaPark\Repository
 */
class RepositoryServiceProvider extends ServiceProvider
{
   /**
    * Register repositories
    */
   public function register()
   {
      $this->registerOwnerRepository();
      $this->registerLotRepository();
   }

   /**
    * Register owner repository
    */
   public function registerOwnerRepository()
   {
      $this->app->bind('SpartaPark\Repository\Owner\OwnerRepository', function($app) {
         return new EloquentOwnerRepository(new Owner());
      });
   }

   /**
    * Register lot repository
    */
   public function registerLotRepository()
   {
      $this->app->bind('SpartaPark\Repository\Lot\LotRepository', function($app) {
         return new EloquentLotRepository(new Lot());
      });
   }
}