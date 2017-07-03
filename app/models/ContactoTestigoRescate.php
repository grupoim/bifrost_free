<?php

class ContactoTestigoRescate extends Eloquent {
	protected $table = 'contacto_testigo_rescate';
	public $timestamps = false;


		public function testigodeinhumado() {
		return $this->belongsTo('TestigoDeInhumado');
	}

		public function tipotelefono() {
		return $this->belongsTo('TipoTelefono');
	}

}