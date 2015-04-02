<?php namespace SpartaPark\Validation;

use Illuminate\Support\ServiceProvider;
use SpartaPark\Validation\Contact\ContactUsFormValidator;

/**
 * Class ValidationServiceProvider
 *
 * @package SpartaPark\Validation
 */
class ValidationServiceProvider extends ServiceProvider
{
   /**
    * Register validators
    */
   public function register()
   {
      $this->registerContactUsFormValidation();
   }

   /**
    * Register contact us form validator
    */
   protected function registerContactUsFormValidation()
   {
      $this->app->bind('SpartaPark\Validation\Contact\ContactUsFormValidator', function($app) {
         return new ContactUsFormValidator($app['validator']);
      });
   }
}