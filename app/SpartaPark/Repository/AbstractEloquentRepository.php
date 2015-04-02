<?php namespace SpartaPark\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository implements Repository, Crudable
{
   /**
    * @var model
    */
   protected $model;

   /**
    * Constructor
    *
    * @param Model $model
    */
   public function __construct(Model $model)
   {
      $this->model = $model;
   }

   /**
    * Get all entities
    *
    * @param array $with
    * @return mixed
    */
   public function all(array $with)
   {
      return $this->make($with)->get();
   }

   /**
    * Get one entity with a condition
    *
    * @param $key
    * @param $value
    * @param array $with relations
    * @return mixed
    */
   public function getOneWhere($key, $value, array $with)
   {
      return $this->make($with)->where($key, '=', $value)->first();
   }

   /**
    * Get many entities with a condition
    *
    * @param $key
    * @param $value
    * @param array $with
    * @return mixed
    */
   public function getManyWhere($key, $value, array $with)
   {
      return $this->make($with)->where($key, '=', $value)->get();
   }

   /**
    * Helper make
    *
    * @param array $with
    * @return mixed|void
    */
   public function make(array $with)
   {
      return $this->model->with($with);
   }

   /**
    * Create an entity
    *
    * @param array $data
    * @return mixed
    */
   public function create(array $data)
   {
      return $this->model->create($data);
   }

   /**
    * Find an entity by id
    *
    * @param $id
    * @param array $with
    * @return mixed
    */
   public function find($id, array $with)
   {
      return $this->make($with)->find($id);
   }

   /**
    * Update an entity by id
    *
    * @param $id
    * @param array $data
    * @return mixed
    */
   public function update($id, array $data)
   {
      return $this->model->update($data);
   }

   /**
    * Delete an entity by id
    *
    * @param $id
    * @return mixed
    */
   public function destroy($id)
   {
      $entity = $this->find($id, array());

      if ($entity) {
         return $entity->delete();
      }
   }
}