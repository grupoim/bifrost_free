<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosolicitanteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dato_solicitante', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('edad');
			$table->date('fecha_nacimiento');
			$table->string('sexo');
			$table->string('dependientes');
			$table->integer('persona_id')->unsigned();
			$table->foreign('persona_id')->references('id')->on('persona');	
			$table->integer('vive_con_id')->unsigned();
			$table->foreign('vive_con_id')->references('id')->on('vive_con');
			$table->integer('colonia_id')->unsigned();
			$table->foreign('colonia_id')->references('id')->on('colonia');
			$table->integer('estado_civil_id')->unsigned();
			$table->foreign('estado_civil_id')->references('id')->on('estado_civil');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dato_solicitante');
	}

}
