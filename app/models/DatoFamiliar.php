<?php

class DatoFamiliar extends Eloquent {
	protected $table = 'dato_familiar';
		public $timestamps = false;


	public function datosolicitante() {
		return $this->belongsTo('DatoSolicitante');
	}
		public function colonia() {
		return $this->belongsTo('Colonia');
	}
		public function datos() {
		return $this->belongsTo('Datos');
	}
}