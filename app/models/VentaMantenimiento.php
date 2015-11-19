<?php

class VentaMantenimiento extends Eloquent {
	protected $table = 'venta_mantenimiento';
	public $timestamps = false;

	public function mantenimientoqueja() {
		return $this->hasMany('MantenimientoQueja');
	}

	public function cesped() {
		return $this->hasMany('Cesped');
	}

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}

	public function empleado() {
		return $this->belongsTo('Empleado');
	}

	public function lote() {
		return $this->belongsTo('Lote');
	}
}