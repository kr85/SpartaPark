<?php

use League\FactoryMuffin\Facade as FactoryMuff;

FactoryMuff::define('Owner', array(
   'name'          => 'name',
   'phone_number'  => 'phoneNumber',
   'email_address' => 'email'
));

FactoryMuff::define('Lot', array(
   'name'      => 'name',
   'address'   => 'address',
   'longitude' => 'longitude',
   'latitude'  => 'latitude',
   'owner_id'  => 'factory|Owner'
));

FactoryMuff::define('Region', array(
   'name'           => 'name',
   'capacity'       => 'numberBetween|200;210',
   'spots_occupied' => 'numberBetween|0;210',
   'lot_id'         => 'factory|Lot'
));

FactoryMuff::define('Entranxit', array(
   'image'       => 'file($sourceDir = \'/tmp\', $targetDir = \'uploads\')',
   'created_at'  => 'date|Ymd h:s',
   'updated_at'  => 'date|Ymd h:s',
   'orientation' => 'string',
   'lot_id'      => 'factory|Lot',
   'region_id'   => 'factory|Region'
));