<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosolicitanteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('contacto_solicitante', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('telefono');
			$table->date('codigo_pais');
			$table->integer('dato_solicitante_id')->unsigned();
			$table->foreign('dato_solicitante_id')->references('id')->on('dato_solicitante');
			$table->integer('tipo_telefono_id')->unsigned();
			$table->foreign('tipo_telefono_id')->references('id')->on('tipo_telefono');
		
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
