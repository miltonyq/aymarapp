<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAymapalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aymapals', function($table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('palabra');
			$table->string('imagen_src');
			$table->string('audio_src');

			$table->integer('espapal_id')->unsigned()->nullable();
			$table->foreign('espapal_id')->references('id')->on('espapals')
			->onDelete('CASCADE')
			->onUpdate('CASCADE');

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
		Schema::drop('aymapals');
		//
	}

}
