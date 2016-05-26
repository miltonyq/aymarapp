<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAymaoracionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aymaoraciones', function($table)
		{
		  $table->engine = 'InnoDB';
		  $table->increments('id');

		  $table->string('oracion');
		  $table->string('imagen_src');
		  $table->string('audio_src');

          $table->integer('espaoracione_id')->unsigned()->nullable();
          $table->foreign('espaoracione_id')->references('id')->on('espaoraciones')
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
		Schema::drop('aymaoraciones');
		//
	}

}
