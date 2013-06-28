<?php
use Illuminate\Database\Migrations\Migration;

class CreateMaintainers extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maintainers', function($table) {
			$table->increments('id');
				$table->string('name');
				$table->string('email');
				$table->string('homepage');
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
		Schema::drop('maintainers');
	}

}