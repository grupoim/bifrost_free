<?php

class Venta extends Eloquent {
	protected $table = 'venta';

	public function getFechaAttribute($fecha){
		return date('d-m-Y', strtoTime($fecha));
	}

	public function ventaproducto() {
		return $this->hasMany('VentaProducto');
	}

	public function comision() {
		return $this->hasMany('Comision');
	}

	public function seguimientoventa() {
		return $this->hasMany('SeguimientoVenta');
	}

	public function cliente() {
		return $this->belongsTo('Cliente');
	}

	public function cuponventa() {
		return $this->hasMany('CuponVenta');
	}

	public function planpagoventa() {
		return $this->hasMany('PlanPagoVenta');
	}

	public function recibo() {
		return $this->hasMany('Recibo');
	}
}