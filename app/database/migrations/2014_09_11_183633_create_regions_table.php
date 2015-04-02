<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      if (App::environment() == 'testing') {
         Schema::create('regions', function(Blueprint $table)
         {
            $table->increments('id');
            $table->string('name');
            $table->integer('capacity');
            $table->integer('spots_occupied');
            $table->unsignedInteger('lot_id')->default(0);
            $table->foreign('lot_id')
               ->references('id')->on('lots')
               ->onDelete('cascade');
         });
      } else {
         Schema::create('regions', function(Blueprint $table)
         {
            $table->increments('id');
            $table->string('name');
            $table->integer('capacity');
            $table->integer('spots_occupied');
            $table->unsignedInteger('lot_id')->default(0);
            $table->foreign('lot_id')
               ->references('id')->on('lots')
               ->onDelete('cascade');
            $table->timestamps();
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
		Schema::drop('regions');
	}

}
