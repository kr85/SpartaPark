<?php

/**
 * Class Region
 */
class Region extends Eloquent
{
   /**
    * @var string Name of the table
    */
   protected $table = 'regions';

   /**
    * @var array Properties that can be mass assigned
    */
   protected $fillable = array();

   /**
    * Region belongs to a lot
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function lots()
   {
      return $this->belongsTo('Lot', 'lot_id');
   }

   /**
    * Region has an Entrance and Exit
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function entranxits()
   {
      return $this->hasMany('Entranxit', 'region_id');
   }
}