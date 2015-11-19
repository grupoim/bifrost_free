<?php

class ConceptoCapacidad extends Eloquent {
	protected $table = 'concepto_capacidad';
	public $timestamps = false;

	public function capacidad() {
		return $this->hasMany('Capacidad');
	}
}