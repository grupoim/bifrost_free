<?php

class VentaExhumacion extends Eloquent {
	protected $table = 'venta_exhumacion';
	public $timestamps = false;

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}

	public function inhumado() {
		return $this->belongsto('Inhumado');
	}

	public function panteonventaexhumacion() {
		return $this->hasMany('PanteonVentaExhumacion');
	}
}