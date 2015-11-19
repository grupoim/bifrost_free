<?php

class Cesped extends Eloquent {
	protected $table = 'cesped';
	public $timestamps = false;

	public function ventamantenimiento() {
		return $this->belongsTo('VentaMantenimiento');
	}
}