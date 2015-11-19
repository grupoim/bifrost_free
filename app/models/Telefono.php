<?php

class Telefono extends Eloquent {
	protected $table = 'telefono';
	public $timestamps = false;

	public function cliente() {
		return $this->belongsTo('Cliente');
	}

	public function tipotelefono() {
		return $this->belongsTo('TipoTelefono');
	}
}