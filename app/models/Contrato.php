<?php

class Contrato extends Eloquent {
	protected $table = 'contrato';
	public $timestamps = false;

	public function contratoventaproducto() {
		return $this->hasMany('ContratoVentaProducto');
	}

	public function formato() {
		return $this->belongsTo('Formato');
	}

	public function ventatramite() {
		return $this->hasMany('VentaTramite');
	}
}