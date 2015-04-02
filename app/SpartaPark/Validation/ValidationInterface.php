<?php namespace SpartaPark\Validation;

/**
 * Interface ValidationInterface
 *
 * @package SpartaPark\Validation
 */
interface ValidationInterface
{
   /**
    * Passes validation rules and input
    *
    * @return mixed
    */
   public function passes();

   /**
    * Returns validation errors
    *
    * @return mixed
    */
   public function errors();

   /**
    * Sets input to validate
    *
    * @param array $input input
    * @return mixed
    */
   public function with(array $input);
}