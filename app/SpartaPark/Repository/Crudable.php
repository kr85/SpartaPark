<?php namespace SpartaPark\Repository;

/**
 * Interface Crudable
 *
 * @package SpartaPark\Repository
 */
interface Crudable
{
   /**
    * Create an entity
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data);

   /**
    * Find an entity by id
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
   public function find($id, array $with);

   /**
    * Update an entity by id
    *
    * @param $id
    * @param array $data
    * @return mixed
    */
   public function update($id, array $data);

   /**
    * Delete an entity by id
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id);
}