<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
	Schema::create('solicitud', function(Blueprint $table)
		{
		$table->increments('id');
			$table->string('puesto');
			$table->string('sueldo');
			$table->timestamps();
			$table->string('zona');
			$table->integer('cordinador_id')->unsigned();
			$table->foreign('cordinador_id')->references('id')->on('cordinador');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('solicitud');
	}

}
