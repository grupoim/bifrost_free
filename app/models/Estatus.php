<?php

class Estatus extends Eloquent {
	protected $table = 'estatus';
	public $timestamps = false;

	public function etapa() {
		return $this->belongsTo('Etapa');
	}

	public function ventarecubrimiento() {
		return $this->belongsTo('VentaRecubrimiento');
	}
}