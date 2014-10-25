<?php namespace SpartaPark\Validation\Contact;

use SpartaPark\Validation\SpartaParkValidator;
use SpartaPark\Validation\ValidationInterface;

/**
 * Class ContactUsFormValidator
 *
 * @package SpartaPark\Validation\Contact
 */
class ContactUsFormValidator extends SpartaParkValidator implements ValidationInterface
{
   /**
    * @var array Validation rules for submitting the contact us form
    */
   protected $rules = array(
      'first_name' => 'required|alpha',
      'last_name'  => 'required|alpha',
      'email'      => 'required|email',
      'subject'    => 'required|min:3',
      'message'    => 'required|min:20'
   );
}