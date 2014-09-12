<?php

use Faker\Factory as Faker;

class OwnersTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

      for ($i = 0; $i < 10; $i++) {
         Owner::create(array(
            'name'          => $faker->name,
            'phone_number'  => $faker->phoneNumber,
            'email_address' => $faker->email
         ));
      }
	}

}