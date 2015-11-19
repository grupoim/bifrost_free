<?php

class CuponVenta extends Eloquent {
	protected $table = 'cupon_venta';
	public $timestamps = false;

	public function cupon() {
		return $this->belongsTo('Cupon');
	}

	public function venta() {
		return $this->belongsTo('Venta');
	}
}