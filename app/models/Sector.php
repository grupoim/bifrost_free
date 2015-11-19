<?php

class Sector extends Eloquent {
	protected $table = 'sector';
	public $timestamps = false;

	public function mantenimiento() {
		return $this->hasMany('Mantenimiento');
	}

	public function tramite() {
		return $this->hasMany('Tramite');
	}

	public function recinto() {
		return $this->hasMany('Recinto');
	}

	public function terreno() {
		return $this->hasMany('Terreno');
	}
}