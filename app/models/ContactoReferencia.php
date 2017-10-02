<?php

class ContactoReferencia extends Eloquent {
	protected $table = 'contacto_referencia';
    public $timestamps = false;


	public function referencias() {
		return $this->belongsTo('Referencias');
	}

	public function tipotelefono() {
		return $this->belongsTo('TipoTelefono');
	}
}