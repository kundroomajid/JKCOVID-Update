<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('regions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32)->nullable();
			$table->date('date');
			$table->integer('postive_new')->nullable();
			$table->integer('postive_total')->nullable();
			$table->integer('total_active')->nullable();
			$table->integer('recovered_new')->nullable();
			$table->integer('recovered_total')->nullable();
			$table->integer('deaths_new')->nullable();
			$table->integer('deaths_total')->nullable();
			$table->timestamps(10);
		});
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
