<?php

class ContratoVentaProducto extends Eloquent {
	protected $table = 'contrato_venta_producto';
	public $timestamps = false;

	public function contrato() {
		return $this->belongsTo('Contrato');
	}

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}
}