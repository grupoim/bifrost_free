<?php

class MantenimientoQueja extends Eloquent {
	protected $table = 'mantenimiento_queja';
	public $timestamps = false;

	public function queja() {
		return $this->belongsTo('Queja');
	}

	public function ventamantenimiento() {
		return $this->belongsTo('VentaMantenimiento');
	}
}