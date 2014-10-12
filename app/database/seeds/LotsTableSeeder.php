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
         'longitude' => '-121.8830326',
         'latitude'  => '37.3323731'
      ));

      Lot::create(array(
         'name'      => 'SJSU South Parking Garage',
         'address'   => '330 S 7th Street, San Jose, CA 95112',
         'owner_id'  => '1',
         'longitude' => '-121.8808485',
         'latitude'  => '37.3331113'
      ));

      Lot::create(array(
         'name'      => 'SJSU North Parking Garage',
         'address'   => '421 E San Fernando Street, San Jose, CA 95112',
         'owner_id'  => '1',
         'longitude' => '-121.880713',
         'latitude'  => '37.339324'
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