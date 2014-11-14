<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntranxitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      if (App::environment() == 'testing') {
         Schema::create('entranxits', function(Blueprint $table)
         {
            $table->increments('id');
            $table->string('orientation');
            $table->unsignedInteger('lot_id')->default(0);
            $table->foreign('lot_id')
               ->references('id')->on('lots')
               ->onDelete('cascade');
            $table->unsignedInteger('region_id')->default(0);
            $table->foreign('region_id')
               ->references('id')->on('regions')
               ->onDelete('cascade');
            $table->string('image');
            $table->timestamps();
         });
      } else {
         Schema::create('entranxits', function(Blueprint $table)
         {
            $table->increments('id');
            $table->string('orientation');
            $table->unsignedInteger('lot_id')->default(0);
            $table->foreign('lot_id')
               ->references('id')->on('lots')
               ->onDelete('cascade');
            $table->unsignedInteger('region_id')->default(0);
            $table->foreign('region_id')
               ->references('id')->on('regions')
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
		Schema::drop('entranxits');
	}

}
