<?php

class Inventario extends Eloquent {
	protected $table = 'inventario';
	public $timestamps = false;

	public function almacen() {
		return $this->belongsTo('Almacen');
	}

	public function unidadmedida() {
		return $this->belongsTo('UnidadMedida');
	}

	public function materialvalor() {
		return $this->hasMany('MaterialValor')
	}

	public function movimiento() {
		return $this->hasMany('Movimiento');
	}
}