<?php

use Faker\Factory as Faker;

class RegionsTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

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
      }
	}

}