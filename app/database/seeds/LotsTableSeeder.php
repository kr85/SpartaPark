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

      Lot::create(array(
         'name'      => 'Bicycle Enclosure Site',
         'address'   => 'San Carlos Plaza, San Jose State University',
         'owner_id'  => '1',
         'longitude' => '-121.879700',
         'latitude'  => '37.335067'
      ));

      Lot::create(array(
         'name'      => 'Bicycle Enclosure Site',
         'address'   => 'MacQuarrie Quad, San Jose State University',
         'owner_id'  => '1',
         'longitude' => '-121.881512',
         'latitude'  => '37.333473'
      ));

      Lot::create(array(
         'name'      => 'Bicycle Enclosure Site',
         'address'   => 'Spartan Memorial Paseo, San Jose State University',
         'owner_id'  => '1',
         'longitude' => '-121.883829',
         'latitude'  => '37.333999'
      ));

      Lot::create(array(
         'name'      => 'Bicycle Enclosure Site',
         'address'   => '7th Street Plaza, San Jose State University',
         'owner_id'  => '1',
         'longitude' => '-121.882415',
         'latitude'  => '37.336621'
      ));

      Lot::create(array(
         'name'      => 'Bicycle Enclosure Site',
         'address'   => '9th Street Plaza, San Jose State University',
         'owner_id'  => '1',
         'longitude' => '-121.880186',
         'latitude'  => '37.337231'
      ));

      Lot::create(array(
         'name'      => 'Park & Ride',
         'address'   => '1201 S 7th St, San Jose, CA 95112',
         'owner_id'  => '1',
         'longitude' => '-121.870579',
         'latitude'  => '37.320212'
      ));

      Lot::create(array(
         'name'      => 'City Hall Garage',
         'address'   => '200 E Santa Clara Street, San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.885267',
         'latitude'  => '37.338060'
      ));

      Lot::create(array(
         'name'      => 'Fourth Street Garage',
         'address'   => '44 S 4th Street, San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.885943',
         'latitude'  => '37.336252'
      ));

      Lot::create(array(
         'name'      => 'Colonnade Plaza Garage',
         'address'   => '201 S 4th Street, San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.884559',
         'latitude'  => '37.333375'
      ));

      Lot::create(array(
         'name'      => 'Second & San Carlos',
         'address'   => '280 S 2nd Street, San Jose, CA 95113',
         'owner_id'  => '2',
         'longitude' => '-121.885750',
         'latitude'  => '37.332542'
      ));

      Lot::create(array(
         'name'      => 'Central Place Lot',
         'address'   => '143 S 3rd Street, San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.886984',
         'latitude'  => '37.334146'
      ));

      Lot::create(array(
         'name'      => 'Central Place Parking',
         'address'   => '88 E San Fernando Street, San Jose, CA 95113',
         'owner_id'  => '2',
         'longitude' => '-121.887472',
         'latitude'  => '37.334603'
      ));

      Lot::create(array(
         'name'      => 'Street Parking',
         'address'   => '150-500 E San Fernando Street (between S 4th St and S 10th St), San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.883663',
         'latitude'  => '37.336987'
      ));

      Lot::create(array(
         'name'      => 'Street Parking',
         'address'   => '100-400 S 4th Street (between E San Fernando St and E San Salvador St), San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.884629',
         'latitude'  => '37.333959'
      ));

      Lot::create(array(
         'name'      => 'Street Parking',
         'address'   => '1-500 S 10th Street (between E Santa Clara St and E San Salvador St), San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.878867',
         'latitude'  => '37.337772'
      ));

      Lot::create(array(
         'name'      => 'Street Parking',
         'address'   => '150-450 E San Salvador Street (between S 4th St and S 10th St), San Jose, CA 95112',
         'owner_id'  => '2',
         'longitude' => '-121.877987',
         'latitude'  => '37.333839'
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