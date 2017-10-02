<?php

class Datos extends Eloquent {
	protected $table = 'datos';
	public $timestamps = false;

	public function dato_solicitante() {
		return $this->hasMany('DatoSolicitante');
	}
		public function referencias() {
		return $this->hasMany('Referencias');
	}
		public function escolaridad() {
		return $this->hasMany('Escolaridad');
	}
		public function dato_familiar() {
		return $this->hasMany('DatoFamiliar');
	}

}