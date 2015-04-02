<?php

use Faker\Factory as Faker;

class RegionsTableSeeder extends Seeder
{

	public function run()
	{
      Region::create(array(
         "name" => "Floor 1 - Disabled",
         "capacity" => 5,
         "spots_occupied" => 4,
         'lot_id' => 1
      ));

      Region::create(array(
         "name" => "Floor 1 - General",
         "capacity" => 227,
         "spots_occupied" => 227,
         'lot_id' => 1
      ));

      Region::create(array(
         "name" => "Floor 2 - General",
         "capacity" => 227,
         "spots_occupied" => 198,
         'lot_id' => 1
      ));

      Region::create(array(
         "name" => "Floor 3 - General",
         "capacity" => 227,
         "spots_occupied" => 201,
         'lot_id' => 1
      ));

      Region::create(array(
         "name" => "Floor 4 - General",
         "capacity" => 227,
         "spots_occupied" => 176,
         'lot_id' => 1
      ));

      Region::create(array(
         "name" => "Floor 5 - General",
         "capacity" => 227,
         "spots_occupied" => 100,
         'lot_id' => 1
      ));

      Region::create(array(
         "name" => "Floor 1 - Employee",
         "capacity" => 386,
         "spots_occupied" => 234,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 1 - Disabled",
         "capacity" => 48,
         "spots_occupied" => 7,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 1 - R-Permit Only",
         "capacity" => 5,
         "spots_occupied" => 0,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 1 - 20-Minute Time Zone",
         "capacity" => 12,
         "spots_occupied" => 12,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 2 - General",
         "capacity" => 375,
         "spots_occupied" => 374,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 3 - General",
         "capacity" => 375,
         "spots_occupied" => 299,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 4 - General",
         "capacity" => 375,
         "spots_occupied" => 343,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 5 - General",
         "capacity" => 375,
         "spots_occupied" => 123,
         'lot_id' => 2
      ));

      Region::create(array(
         "name" => "Floor 1 - Disabled",
         "capacity" => 8,
         "spots_occupied" => 7,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 1 - R-Permit Only",
         "capacity" => 7,
         "spots_occupied" => 1,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 1 - 30-Minute Time Zone",
         "capacity" => 29,
         "spots_occupied" => 27,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 1 - Employee",
         "capacity" => 177,
         "spots_occupied" => 150,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 2 - Employee",
         "capacity" => 177,
         "spots_occupied" => 100,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 2 - General",
         "capacity" => 90,
         "spots_occupied" => 90,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 3 - General",
         "capacity" => 280,
         "spots_occupied" => 175,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 4 - General",
         "capacity" => 280,
         "spots_occupied" => 242,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 5 - General",
         "capacity" => 280,
         "spots_occupied" => 185,
         'lot_id' => 3
      ));

      Region::create(array(
         "name" => "Floor 6 - General",
         "capacity" => 280,
         "spots_occupied" => 112,
         'lot_id' => 3
      ));


      // Uncomment to use Faker
		/*$faker = Faker::create();

      for ($i= 0; $i < 5; $i++) {
         Region::create(array(
            'name' => 'Region ' . ($i + 1),
            'capacity' => $faker->numberBetween(10, 40),
            'spots_occupied' => $faker->numberBetween(10, 40),
            'lot_id' => 1
         ));
      }

      for ($i= 0; $i < 5; $i++) {
         Region::create(array(
            'name' => 'Region ' . ($i + 1),
            'capacity' => $faker->numberBetween(10, 40),
            'spots_occupied' => $faker->numberBetween(10, 40),
            'lot_id' => 2
         ));
      }

      for ($i= 0; $i < 5; $i++) {
         Region::create(array(
            'name' => 'Region ' . ($i + 1),
            'capacity' => $faker->numberBetween(10, 40),
            'spots_occupied' => $faker->numberBetween(10, 40),
            'lot_id' => 3
         ));
      }

      for ($i= 0; $i < 5; $i++) {
         Region::create(array(
            'name' => 'Region ' . ($i + 1),
            'capacity' => $faker->numberBetween(10, 40),
            'spots_occupied' => $faker->numberBetween(10, 40),
            'lot_id' => 4
         ));
      }

      for ($i= 0; $i < 5; $i++) {
         Region::create(array(
            'name' => 'Region ' . ($i + 1),
            'capacity' => $faker->numberBetween(10, 40),
            'spots_occupied' => $faker->numberBetween(10, 40),
            'lot_id' => 5
         ));
      }

      for ($i= 0; $i < 5; $i++) {
         Region::create(array(
            'name' => 'Region ' . ($i + 1),
            'capacity' => $faker->numberBetween(10, 40),
            'spots_occupied' => $faker->numberBetween(10, 40),
            'lot_id' => 6
         ));
      }*/
	}

}