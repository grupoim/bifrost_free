<?php

class ContactoRescatista extends Eloquent {
	protected $table = 'contacto_rescatista';
	public $timestamps = false;


		public function resscatista() {
		return $this->belongsTo('Rescatista');
	}

		public function tipotelefono() {
		return $this->belongsTo('TipoTelefono');
	}

}