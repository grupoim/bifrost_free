<?php

class DatoSolicitante extends Eloquent {
	protected $table = 'dato_solicitante';
	public $timestamps = false;

	public function persona() {
		return $this->belongsTo('Persona');
	}
		public function colonia() {
		return $this->belongsTo('Colonia');
	}
		public function estadocivil() {
		return $this->belongsTo('EstadoCivil');
	}
		public function datos() {
		return $this->belongsTo('Datos');
	}

	public function datofamiliar() {
		return $this->hasMany('DatoFamiliar');
	}
		public function prospectos() {
		return $this->hasMany('Prospectos');
	}
		public function referencias() {
		return $this->hasMany('Referencias');
	}
		public function documentos() {
		return $this->hasMany('Documentos');
	}
		public function contactosolicitante() {
		return $this->hasMany('ContactoSolicitante');
	}
		public function estudios() {
		return $this->hasMany('Estudios');
	}
	

}