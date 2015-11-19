<?php

class Capacidad extends Eloquent {
	protected $table = 'capacidad';
	public $timestamps = false;

	public function construccion() {
		return $this->belongsTo('Construccion');
	}

	public function conceptocapacidad() {
		return $this->belongsTo('ConceptoCapacidad');
	}
}