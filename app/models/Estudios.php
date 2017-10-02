<?php

class Estudios extends Eloquent {
	protected $table = 'estudios';
	public $timestamps = false;

	public function datos() {
		return $this->belongsTo('Datos');
	}
		public function datosolicitante() {
		return $this->belongsTo('DatoSolicitante');
	}
		public function colonia() {
		return $this->belongsTo('Colonia');
	}

	

}