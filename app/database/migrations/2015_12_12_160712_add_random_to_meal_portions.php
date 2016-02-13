<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRandomToMealPortions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('meal_portions', function(Blueprint $table)
		{
			$table->integer('portion_type_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('meal_portions', function(Blueprint $table)
		{
			$table->dropColumn('portion_type');
		});
	}

}
