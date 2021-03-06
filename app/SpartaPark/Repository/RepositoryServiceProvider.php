<?php namespace SpartaPark\Repository;

use Illuminate\Support\ServiceProvider;
use SpartaPark\Repository\Lot\EloquentLotRepository;
use SpartaPark\Repository\Owner\EloquentOwnerRepository;
use SpartaPark\Repository\Region\EloquentRegionRepository;
use SpartaPark\Repository\Entranxit\EloquentEntranxitRepository;
use Owner;
use Lot;
use Region;
use Entranxit;
use SpartaPark\Repository\Web\EloquentWebRepository;

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
      $this->registerRegionRepository();
      $this->registerEntranxitRepository();
      $this->registerWebRepository();
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

   /**
    * Register region repository
    */
   public function registerRegionRepository()
   {
      $this->app->bind('SpartaPark\Repository\Region\RegionRepository', function($app) {
         return new EloquentRegionRepository(new Region());
      });
   }

   /**
    * Register entranxit repository
    */
   public function registerEntranxitRepository()
   {
      $this->app->bind('SpartaPark\Repository\Entranxit\EntranxitRepository', function($app) {
         return new EloquentEntranxitRepository(new Entranxit());
      });
   }

   /**
    * Register web repository
    */
   public function registerWebRepository()
   {
      $this->app->bind('SpartaPark\Repository\Web\WebRepository', function($app) {
         return new EloquentWebRepository(new Entranxit());
      });
   }
}