<?php

class Recibo extends Eloquent {
	protected $table = 'recibo';

	public function pago() {
		return $this->hasMany('Pago');
	}

	public function evento() {
		return $this->hasMany('Evento');
	}

	public function venta() {
		return $this->belongsTo('Venta');
	}

	public function getCreatedAtAttribute($fecha){
		return date('d/m/Y', strtoTime($fecha));
	}
}