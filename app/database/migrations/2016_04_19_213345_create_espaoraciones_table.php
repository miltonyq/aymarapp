<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspaoracionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('espaoraciones', function($table)
		{
		  $table->engine = 'InnoDB';
		  $table->increments('id');
		  
          $table->string('oracion');

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
		Schema::drop('espaoraciones');
		//
	}

}
