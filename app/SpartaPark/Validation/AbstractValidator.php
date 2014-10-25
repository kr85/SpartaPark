<?php namespace SpartaPark\Validation;

/**
 * Class AbstractValidator
 *
 * @package SpartaPark\Validation
 */
abstract class AbstractValidator
{
   /**
    * @var array Validation rules
    */
   protected $rules;

   /**
    * @var array input to be validated
    */
   protected $input;

   /**
    * @var array Validation errors
    */
   protected $errors;

   /**
    * Constructor
    */
   public function __construct()
   {
      $this->rules = array();
      $this->input = array();
      $this->errors = array();
   }

   /**
    * Passes the validation rules with input
    *
    * @return mixed
    */
   abstract function passes();

   /**
    * Returns the validation errors
    *
    * @return array errors
    */
   public function errors()
   {
      return $this->errors;
   }

   /**
    * Sets data to be validated
    *
    * @param array $input input to be validated
    * @return $this data to be validated
    */
   public function with(array $input)
   {
      $this->input = $input;

      return $this;
   }
}