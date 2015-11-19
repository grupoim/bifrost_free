<?php

class Titular extends Eloquent {
	protected $table = 'titular';
	public $timestamps = false;

	public function persona() {
		return $this->belongsTo('Persona');
	}

	public function ventalote() {
		return $this->belongsTo('VentaLote');
	}
}