<?php

class MedioComunicacion extends Eloquent {
	protected $table = 'medio_comunicacion';
	public $timestamps = false;

	public function seguimientoventa() {
		return $this->hasMany('SeguimientoVenta');
	}
}