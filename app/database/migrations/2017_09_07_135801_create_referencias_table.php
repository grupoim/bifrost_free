<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('referencia', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('persona_id')->unsigned();
			$table->foreign('persona_id')->references('id')->on('persona');
			$table->integer('colonia_id')->unsigned();
			$table->foreign('colonia_id')->references('id')->on('colonia');
			$table->integer('ocupacion_id')->unsigned();
			$table->foreign('ocupacion_id')->references('id')->on('ocupacion');
			$table->string('tiempo_conocerlo');
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
