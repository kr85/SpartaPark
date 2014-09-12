<?php

/**
 * Class Owner
 */
class Owner extends Eloquent
{
   /**
    * @var string Name of the table
    */
   protected $table = 'owners';

   /**
    * @var array Validation rules
    */
   public static $rules = array();

   /**
    * @var array Properties that can be mass assigned
    */
   protected $fillable = array();

   /**
    * Owner has many lots
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function lots()
   {
      return $this->hasMany('Lot', 'owner_id');
   }
}