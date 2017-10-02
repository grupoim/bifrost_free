<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('prospectos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('solicitud_id')->unsigned();
			$table->foreign('solicitud_id')->references('id')->on('solicitud');
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
