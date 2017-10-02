<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoreferenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacto_referencia', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('telefono');
			$table->date('codigo_pais');
			$table->integer('referencia_id')->unsigned();
			$table->foreign('referencia_id')->references('id')->on('referencia');
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
