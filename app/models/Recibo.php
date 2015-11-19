<?php

class Recibo extends Eloquent {
	protected $table = 'recibo';

	public function pago() {
		return $this->hasMany('Pago');
	}

	public function venta() {
		return $this->belongsTo('Venta');
	}
}