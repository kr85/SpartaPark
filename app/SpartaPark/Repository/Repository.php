<?php namespace SpartaPark\Repository;

/**
 * Interface Repository
 *
 * @package SpartaPark\Repository
 */
interface Repository
{
   /**
    * Get all entities.
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with);

   /**
    * Get one entity with a condition
    *
    * @param $key
    * @param $value
    * @param array $with relations
    * @return mixed
    */
   public function getOneWhere($key, $value, array $with);

   /**
    * Get many entities with a condition
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return mixed
    */
   public function getManyWhere($key, $value, array $with);

   /**
    * Helper make
    *
    * @param array $with
    * @return mixed
    */
   public function make(array $with);
}