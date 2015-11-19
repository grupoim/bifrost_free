<?php

class VentaRecubrimiento extends Eloquent {
	protected $table = 'venta_recubrimiento';
	public $timestamps = false;

	public function estatus() {
		return $this->hasMany('Estatus');
	}

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}
}