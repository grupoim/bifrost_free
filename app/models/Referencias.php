<?php

class Referencias extends Eloquent {
	protected $table = 'referencias';
	public $timestamps = false;

	public function contactoreferencia() {
		return $this->hasMany('ContactoReferencia');
	}
	public function datosolicitante() {
		return $this->belongsTo('DatoSolicitante');
	}
	public function persona() {
		return $this->belongsTo('Persona');
	}
		public function colonia() {
		return $this->belongsTo('Colonia');
	}
		public function datos() {
		return $this->belongsTo('Datos');
	}
}