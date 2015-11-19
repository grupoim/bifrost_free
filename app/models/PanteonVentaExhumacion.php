<?php

class PanteonVentaExhumacion extends Eloquent {
	protected $table = 'panteon_venta_exhumacion';
	public $timestamps = false;

	public function ventaexhumacion() {
		return $this->belongsTo('VentaExhumacion');
	}

	public function panteon() {
		return $this->belongsTo('Panteon');
	}
}