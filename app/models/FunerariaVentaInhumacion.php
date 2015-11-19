<?php

class FunerariaVentaInhumacion extends Eloquent {
	protected $table = 'funeraria_venta_inhumacion';
	public $timestamps = false;

	public function capilla() {
		return $this->belongsTo('Capilla');
	}

	public function ventainhumacion() {
		return $this->belongsTo('VentaInhumacion');
	}
}