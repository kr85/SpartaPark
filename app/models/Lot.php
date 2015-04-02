<?php

/**
 * Class Lot
 */
class Lot extends Eloquent
{
   /**
    * @var string Name of the table
    */
   protected $table = 'lots';

   /**
    * @var array Properties that can be mass assigned
    */
   protected $fillable = array();

   /**
    * @var bool timestamps disabled
    */
   public $timestamps = false;

   /**
    * Lot belongs to a owner
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function owners()
   {
      return $this->belongsTo('Owner', 'owner_id');
   }

   /**
    * Lot has many regions
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function regions()
   {
      return $this->hasMany('Region', 'lot_id');
   }

   /**
    * Lot has an Entrance and Exit
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function entranxits()
   {
      return $this->hasMany('Entranxit', 'lot_id');
   }
}