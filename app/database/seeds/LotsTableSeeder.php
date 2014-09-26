<?php

use Faker\Factory as Faker;

class LotsTableSeeder extends Seeder
{

	public function run()
	{
      Lot::create(array(
         'name'      => 'SJSU West Parking Garage',
         'address'   => '348 S 4th Street, San Jose, CA 95112',
         'owner_id'  => '1',
         'longitude' => '-121.8833592',
         'latitude'  => '37.3322593'
      ));

      Lot::create(array(
         'name'      => 'SJSU South Parking Garage',
         'address'   => '330 S 7th Street, San Jose, CA 95112',
         'owner_id'  => '1',
         'longitude' => '-121.8799164',
         'latitude'  => '37.3334737'
      ));

      Lot::create(array(
         'name'      => 'SJSU North Parking Garage',
         'address'   => '421 E San Fernando Street, San Jose, CA 95112',
         'owner_id'  => '1',
         'longitude' => '-121.8805469',
         'latitude'  => '37.338473'
      ));


      // Uncomment to use Faker
		/*$faker = Faker::create();

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 1,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 2,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 3,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 4,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 5,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 6,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 7,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 8,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 9,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }

      for ($i = 0; $i < 5; $i++) {
         Lot::create(array(
            'name'      => 'Lot ' . ($i + 1),
            'address'   => $faker->address,
            'owner_id'  => 10,
            'longitude' => $faker->longitude,
            'latitude'  => $faker->latitude
         ));
      }*/
	}

}