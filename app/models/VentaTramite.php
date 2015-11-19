<?php

class VentaTramite extends Eloquent {
	protected $table = 'venta_tramite';
	public $timestamps = false;

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}

	public function contrato() {
		return $this->belongsTo('Contrato');
	}
}