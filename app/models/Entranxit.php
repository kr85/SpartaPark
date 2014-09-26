<?php

/**
 * Class Entranxit
 */
class Entranxit extends Eloquent
{
   /**
    * @var string Name of the table
    */
   protected $table = 'entranxits';

   /**
    * @var array Properties that can be mass assigned
    */
   protected $fillable = array(
      'lot_id',
      'region_id',
      'orientation',
      'image'
   );

   /**
    * Entrance and Exit belong to a lot
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function lots()
   {
      return $this->belongsTo('Lot', 'lot_id');
   }

   /**
    * Entrance and Exit belong to a region
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function regions()
   {
      return $this->belongsTo('Region', 'region_id');
   }
}