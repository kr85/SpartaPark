<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lots', function(Blueprint $table)
		{
			$table->increments('id');
         $table->string('name');
         $table->string('address');
         $table->unsignedInteger('owner_id')->default(0);
         $table->foreign('owner_id')
            ->references('id')->on('owners')
            ->onDelete('cascade');
         $table->decimal('longitude', 10, 8);
         $table->decimal('latitude', 11, 8);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lots');
	}

}
