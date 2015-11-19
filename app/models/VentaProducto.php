<?php

class VentaProducto extends Eloquent {
	protected $table = 'venta_producto';
	public $timestamps = false;

	public function ventalote() {
		return $this->hasMany('VentaLote');
	}

	public function ventamantenimiento() {
		return $this->hasMany('VentaMantenimiento');
	}

	public function venta() {
		return $this->belongsTo('Venta');
	}

	public function producto() {
		return $this->belongsTo('Producto');
	}

	public function ventaconstruccion() {
		return $this->hasMany('VentaConstruccion');
	}

	public function contratoventaproducto() {
		return $this->hasMany('ContratoVentaProducto');
	}

	public function ventatramite() {
		return $this->hasMany('VentaTramite');
	}

	public function ventarecubrimiento(){
		return $this->hasMany('VentaRecubrimiento');
	}

	public function ventainhumacion() {
		return $this->hasMany('VentaInhumacion');
	}

	public function ventaexhumacion() {
		return $this->hasMany('VentaExhumacion');
	}
}