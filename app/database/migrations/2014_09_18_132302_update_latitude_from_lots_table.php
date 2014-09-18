<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateLatitudeFromLotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::table('lots', function(Blueprint $table)
      {
         $table->dropColumn('latitude');
      });

      Schema::table('lots', function(Blueprint $table)
      {
         $table->decimal('latitude', 12, 8);
      });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
      Schema::table('lots', function(Blueprint $table)
      {
         $table->dropColumn('latitude');
      });

      Schema::table('lots', function(Blueprint $table)
      {
         $table->decimal('latitude', 11, 8);
      });
	}

}
