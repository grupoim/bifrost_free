<?php

class VentaConstruccion extends Eloquent {
	protected $table = 'venta_construccion';
	public $timestamps = false;

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}

	public function terreno() {
		return $this->belongsTo('Terreno');
	}
}