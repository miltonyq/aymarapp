<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seguimientos', function($table)
		{
		  $table->engine = 'InnoDB';
		  $table->increments('id');
		  
          $table->boolean('estado')->default(0);
          $table->integer('puntos');
          $table->boolean('avance')->default(0);

          $table->integer('persona_id')->unsigned()->nullable();
          $table->foreign('persona_id')->references('id')->on('personas')
          ->onDelete('CASCADE')
          ->onUpdate('CASCADE');

          $table->integer('categoria_id')->unsigned()->nullable();
          $table->foreign('categoria_id')->references('id')->on('categorias')
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
		Schema::drop('seguimientos');
		//
	}

}
