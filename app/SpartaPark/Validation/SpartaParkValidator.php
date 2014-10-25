<?php namespace SpartaPark\Validation;

use Illuminate\Validation\Factory as Validator;

/**
 * Class SpartaParkValidator
 *
 * @package SpartaPark\Validation
 */
abstract class SpartaParkValidator extends AbstractValidator
{
   /**
    * @var \Illuminate\Validation\Factory Validation instance
    */
   protected $validator;

   /**
    * Constructor
    *
    * @param Validator $validator validator
    */
   public function __construct(Validator $validator)
   {
      $this->validator = $validator;
   }

   /**
    * Passes the validation rules with input
    *
    * @return bool|mixed true if passes, otherwise false
    */
   public function passes()
   {
      // Makes a validator with input and rules
      $validator = $this->validator->make(
         $this->input,
         $this->rules
      );

      // Checks if the validator fails
      if ($validator->fails()) {
         $this->errors = $validator->messages();
         return false;
      }

      return true;
   }
}