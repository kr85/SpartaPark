<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveTimestampsFromLotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      if (App::environment() == 'testing') {
         // No need in testing environment
      } else {
         Schema::table('lots', function(Blueprint $table)
         {
            $table->dropTimestamps();
         });
      }
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
      if (App::environment() == 'testing') {
         // No need in testing environment
      } else {
         Schema::table('lots', function(Blueprint $table)
         {
            $table->timestamps();
         });
      }
	}

}
