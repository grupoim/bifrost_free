<?php

class Beneficiario extends Eloquent {
	protected $table = 'beneficiario';
	public $timestamps = false;

	public function ventalote() {
		return $this->belongsTo('VentaLote');
	}

	public function persona() {
		return $this->belongsTo('Persona');
	}
}