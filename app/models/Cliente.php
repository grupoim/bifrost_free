<?php

class Cliente extends Eloquent {
	protected $table = 'cliente';
	public $timestamps = false;

	public function venta() {
		return $this->hasMany('Venta');
	}

	public function cupon() {
		return $this->hasMany('Cupon');
	}

	public function persona() {
		return $this->belongsTo('Persona');
	}

	public function colonia() {
		return $this->belongsTo('Colonia');
	}

	public function estadocivil() {
		return $this->belongsTo('EstadoCivil');
	}

	public function telefono() {
		return $this->hasMany('Telefono');
	}
}