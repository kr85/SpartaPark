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
   'capacity'       => 'numberBetween($min = 200, $max = 210)',
   'spots_occupied' => 'numberBetween($min = 0, $max = 210)',
   'lot_id'         => 'factory|Lot'
));

FactoryMuff::define('Entranxit', array(

));