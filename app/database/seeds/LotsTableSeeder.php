<?php

use Faker\Factory as Faker;

class LotsTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 1,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 2,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 3,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 4,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 5,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 6,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 7,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 8,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 9,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => $faker->name,
            'address'   => $faker->address,
            'owner_id'  => 10,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }
	}

}