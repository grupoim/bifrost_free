<?php

class Orden extends Eloquent {
	protected $table = 'orden';
	public $timestamps = false;
	public function inventario() {
		return $this->belongsTo('Inventario');
	}

	public function apertura_orden() {
		return $this->belongsTo('AperturaOrden');
	}
}