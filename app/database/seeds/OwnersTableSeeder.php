<?php

use Faker\Factory as Faker;

class OwnersTableSeeder extends Seeder
{

	public function run()
	{
      Owner::create(array(
         'name'          => 'San Jose State University',
         'phone_number'  => '408-924-1000',
         'email_address' => 'admin@sjsu.edu'
      ));

      // Uncomment to use Faker
		/*$faker = Faker::create();

      for ($i = 0; $i < 10; $i++) {
         Owner::create(array(
            'name'          => $faker->name,
            'phone_number'  => $faker->phoneNumber,
            'email_address' => $faker->email
         ));
      }*/
	}

}