<?php

class Terreno extends Eloquent {
	protected $table = 'terreno';
	public $timestamps = false;

	public function ventaconstruccion() {
		return $this->hasMany('VentaConstruccion');
	}

	public function lote() {
		return $this->belongsTo('Lote');
	}

	public function sector() {
		return $this->belongsTo('Sector');
	}

	public function construccion() {
		return $this->belongsTo('Construccion');
	}
}