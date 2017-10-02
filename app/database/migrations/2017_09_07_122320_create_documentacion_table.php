<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('documentacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('curp');
			$table->string('rfc');
			$table->string('imss');
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
