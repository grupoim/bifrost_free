<?php

class Construccion extends Eloquent {
	protected $table = 'construccion';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}

	public function mantenimiento() {
		return $this->hasMany('Mantenimiento');
	}

	public function tramite() {
		return $this->hasMany('Tramite');
	}

	public function terreno() {
		return $this->hasMany('Terreno');
	}

	public function capacidad() {
		return $this->hasMany('Capacidad');
	}
}