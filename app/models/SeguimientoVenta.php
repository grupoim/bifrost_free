<?php

class SeguimientoVenta extends Eloquent {
	protected $table = 'seguimiento_venta';

	public function venta() {
		return $this->belongsTo('Venta');
	}

	public function mediocomunicacion() {
		return $this->belongsTo('MedioComunicacion');
	}
}