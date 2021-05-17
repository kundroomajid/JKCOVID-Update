<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionCoordinatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('region_coordinates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32);
			$table->float('latitude', 10, 0);
			$table->float('longitude', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('region_coordinates');
	}

}
