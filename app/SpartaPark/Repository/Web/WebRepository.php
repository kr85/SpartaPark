<?php namespace SpartaPark\Repository\Web;

use SpartaPark\Repository\Crudable;
use SpartaPark\Repository\Repository;

/**
 * Interface WebRepository
 *
 * @package SpartaPark\Repository\Web
 */
interface WebRepository extends Repository, Crudable
{
   /**
    * Checks whether the object is a car or not
    *
    * @param $image path to an image
    * @return mixed
    */
   public function isCar($image);
}