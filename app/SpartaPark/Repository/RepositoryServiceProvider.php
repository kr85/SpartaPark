<?php namespace SpartaPark\Repository;

use Illuminate\Support\ServiceProvider;
use SpartaPark\Repository\Owner\EloquentOwnerRepository;
use Owner;

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
}