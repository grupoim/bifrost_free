<?php

class VentaLote extends Eloquent {
	protected $table = 'venta_lote';
	public $timestamps = false;

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}

	public function titular() {
		return $this->hasMany('Titular');
	}

	public function beneficiario() {
		return $this->hasMany('Beneficiario');
	}
}