<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('nombres');
			$table->string('apellidos');
			$table->integer('edad');
			$table->boolean('sexo')->default(0);
			$table->string('avatar_src');

			$table->timestamps();
		});
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
		//
	}

}
