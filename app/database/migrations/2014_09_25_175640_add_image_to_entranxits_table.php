<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImageToEntranxitsTable extends Migration {

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
         Schema::table('entranxits', function(Blueprint $table)
         {
            $table->string('image');
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
         Schema::table('entranxits', function(Blueprint $table)
         {
            $table->dropColumn('image');
         });
      }
	}

}
