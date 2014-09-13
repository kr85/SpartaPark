<?php namespace SpartaPark\Repository;

/**
 * Interface Repository
 *
 * @package SpartaPark\Repository
 */
interface Repository
{
   /**
    * Get all properties
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with);

   /**
    * Get one property with a condition
    *
    * @param $key
    * @param $value
    * @param array $with relations
    * @return mixed
    */
   public function getOneWhere($key, $value, array $with);

   /**
    * Get many properties with a condition
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return mixed
    */
   public function getManyWhere($key, $value, array $with);
}