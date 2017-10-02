<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscolaridadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('escolaridad', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->date('fecha_inicio');
			$table->date('fecha_fin');
			$table->integer('titulo_id')->unsigned();
			$table->foreign('titulo_id')->references('id')->on('titulo');
			$table->integer('colonia_id')->unsigned();
			$table->foreign('colonia_id')->references('id')->on('colonia');
			$table->integer('nivel_estudio_id')->unsigned();
			$table->foreign('nivel_estudio_id')->references('id')->on('nivel_estudio');
		    $table->integer('dato_solicitante_id')->unsigned();
			$table->foreign('dato_solicitante_id')->references('id')->on('dato_solicitante');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
