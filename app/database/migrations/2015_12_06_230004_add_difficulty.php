<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDifficulty extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portions', function(Blueprint $table)
		{
			$table->integer('difficulty')->default(5);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('portions', function(Blueprint $table)
		{
			$table->dropColumn('difficulty');
		});
	}

}
