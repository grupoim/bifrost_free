<?php

class VentaInhumacion extends Eloquent {
	protected $table = 'venta_inhumacion';
	public $timestamps = false;

	public function funerariaventainhumacion() {
		return $this->hasMany('FunerariaVentaInhumacion');
	}

	public function ventaproducto() {
		return $this->belongsTo('VentaProducto');
	}

	public function lote() {
		return $this->belongsTo('Lote');
	}

	public function inhumado() {
		return $this->belongsTo('Inhumado');
	}
}